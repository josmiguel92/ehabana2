<?php

namespace App\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;

class BackendController extends AbstractController
{
    /**
     * @Route("/backend", name="backend_dashboard")
     */
    public function index()
    {
        return $this->render('backend/index.html.twig', [

        ]);
    }

    /**
     * @Route("/backend/_profileinfo", name="backend_partial_profile")
     */
    public function _profileinfo()
    {
        $response =  $this->render('backend/_profile-info.html.twig', [

        ]);
        $response->setSharedMaxAge(600);
        return $response;
    }


    /**
     * @Route("/backend/_settings_activities", name="backend_settings_activities")
     */
    public function _settings_activities()
    {
        $response = $this->render('backend/_settings-activities.html.twig', [

        ]);
        $response->setSharedMaxAge(600);
        return $response;
    }



    /**
     * @Route("/backend/_sidebar/{pagename}", name="backend_sidebar")
     */
    public function _sidebar($pagename)
    {
        $response = $this->render('backend/_sidebar.html.twig', [
            'pagename'=>$pagename
        ]);
        $response->setSharedMaxAge(600);
        return $response;
    }

}
