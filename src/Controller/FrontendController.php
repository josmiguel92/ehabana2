<?php

namespace App\Controller;

use App\Entity\Food;
use App\Repository\FoodRepository;
use App\Repository\HeaderImageRepository;
use App\Repository\HomeTextRepository;
use App\Repository\OfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Booking;
use App\Form\BookingType;
use App\DataHelper\UtmCampaign;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class FrontendController extends AbstractController
{
    /**
     * @Route("/{_locale}",
     *     defaults={"_locale": "es"},
     *     requirements={"_locale": "en|es|fr"},
     *     name="frontend")
     * @Cache(expires="+24 hour", maxage=15, public=true, mustRevalidate=false)
     */
    public function index($_locale, FoodRepository $foodRepository, OfferRepository $offerRepository,
                          HomeTextRepository $textRepository, HeaderImageRepository $imageRepository,
                          Request $request)
    {

        $featuresFoodList = $foodRepository->findAll();

        $offer = null;
        if($offer = $offerRepository->findAll()) {
          $offer = $offer[array_rand($offer)];
        }

        $text = $textRepository->findAll();
        $text = array_shift($text);

        $images = $imageRepository->findAll();
        $images = array_slice($images, 0,5);


        $campaign = new UtmCampaign($request);
        $booking = new Booking();
        $booking->setCampaign($campaign->getContent());
        $booking->setBookingLang($_locale);
        $form = $this->createForm(BookingType::class,
            $booking,
            ['action'=> $this->generateUrl('booking'),
            'method'=>'POST',
            ]);



        return $this->render('frontend/index.html.twig', [
                'form' => $form->createView(),
                'featuresFoodList' => $featuresFoodList,
                'offer' => $offer,
                'text' => $text,
                'images' => $images,
                '_locale' => $_locale,
        ]);
    }

    /**
     * @Route("/booking", name="booking")
     */
    public function booking(Request $request, \Swift_Mailer $mailer)
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();

            $message = (new \Swift_Message('Nueva reserva en ElizaldeHabana - '.$booking->getOrderNumber()))
                ->setFrom(['bookings@restauranteelizaldehabana.com'=>'RestaurantElizaldeHabana'])
                ->setTo('elizaldebarrestaurante@gmail.com')
                ->setBody(
                    $this->renderView(
                        'emails/bookingNotification.html.twig',
                        ['booking' => $booking]
                    ),
                    'text/html',
                    'UTF-8'
                );

            $mailer->send($message);

            $message = (new \Swift_Message('Nueva reserva en ElizaldeHabana - '.$booking->getOrderNumber()))
                ->setFrom(['bookings@restauranteelizaldehabana.com'=>'RestaurantElizaldeHabana'])
                ->setTo($booking->getClientEmail())
                ->setBody(
                    $this->renderView(
                        'emails/clients/clientNotificationOnBooking.html.twig',
                        ['booking' => $booking]
                    ),
                    'text/html',
                    'UTF-8'
                );
            $mailer->send($message);
        }
        return $this->render('frontend/after_booking.html.twig', [
            'booking' => $booking,
    ]);
    }

}
