<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Form\ContactType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

class FrontendController extends AbstractController
{
    /**
     * @Route("/{_locale}",
     *     defaults={"_locale": "en"},
     *     requirements={"_locale": "en|es|fr"},
     *     name="frontend")
     * @Cache(expires="+12 hour", maxage=15, public=true, mustRevalidate=false)
     */
    public function index($_locale)
    {
//        $form = $this->createForm(ContactType::class,
//            new Contact(),
//            ['action'=> $this->generateUrl('contact'),
//            'method'=>'POST',
//            ]);


        return $this->render('frontend/index.html.twig', [
//            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/booking", name="booking")
     */
    public function booking(Request $request)
    {
        return $this->json(['status'=>'success']);
    }

}
