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
        return $this->render('backend/base.html.twig', [

        ]);
    }


}
