<?php

namespace App\Controller;

use App\Entity\Food;
use App\Repository\FoodRepository;
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
    public function booking(Request $request)
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();

        }
        return $this->render('frontend/after_booking.html.twig', [
            'booking' => $booking,
    ]);
    }

}
