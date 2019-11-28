<?php

namespace App\Controller;

use App\Entity\Food;
use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Mailer;
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
    public function index($_locale, FoodRepository $foodRepository, Request $request)
    {

        $featuresFoodList = $foodRepository->findAll();

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
                '_locale' => $_locale,
        ]);
    }

    /**
     * @Route("/booking", name="booking")
     */
    public function booking(Request $request, Mailer $mailer)
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
                ->setBcc(['josmiguel92+elizalde@gmail.com'])
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
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
                ->setBcc(['josmiguel92+elizalde@gmail.com'])
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
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
