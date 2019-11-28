<?php

namespace App\Controller;

use App\Entity\Food;
use App\EventMessages\Booking\NewBookingMsg;
use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
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
    public function booking(Request $request, MailerInterface $mailer, MessageBusInterface $bus)
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();

            $bus->dispatch(new NewBookingMsg($booking));
        }
        return $this->render('frontend/after_booking.html.twig', [
            'booking' => $booking,
    ]);
    }

    /**
     * @Route("/{_locale}/booking/confirmation/{orderNumber}", name="booking_confirmation", methods={"GET"},
     *     defaults={"_locale": "en"},
     *     requirements={"_locale": "en|es|fr"})
     * @Route("/booking/confirmation/{orderNumber}", methods={"GET"})
     */
    public function confirmation(Booking $booking): Response
    {
      return $this->render('frontend/booked.html.twig', [
        'booking' => $booking,
        'orderNumber'=>$booking->getOrderNumber()
      ]);
    }

}
