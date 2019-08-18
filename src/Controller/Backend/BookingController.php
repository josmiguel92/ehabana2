<?php

namespace App\Controller\Backend;

use App\DataHelper\TelephoneNumber;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


class BookingController extends AbstractController
{
    /**
     * @Route("/backend/booking/", name="booking_index", methods={"GET"})
     * @Route("/backend/booking/p/{page}", name="booking_index_paged", methods={"GET"}, requirements={"page":"\d+"})
     */
    public function index(BookingRepository $bookingRepository, $page = 1): Response
    {
        $limit = 10;
        if($page == 0)
            $bookings = $bookingRepository->findAll();
        else
            $bookings = $bookingRepository->findBy([],['id'=>'DESC'],$limit, ($page-1)*$limit);

        $count = $bookingRepository->count([]);
        $last_page = $count%$limit;
        return $this->render('backend/booking/index.html.twig', [
            'bookings' => $bookings,
            'page' => $page,
            'count' => $count,
            'last_page' => $last_page,
        ]);
    }

    /**
     * @Route("/{_locale}/booking/new", name="booking_new", methods={"GET","POST"}, defaults={"_locale": "en"},
     *     requirements={"_locale": "en|es|fr"})
     * @Route("/booking/new", methods={"GET","POST"})
     */
    public function new(Request $request,
                         \Swift_Mailer $mailer,
                         $_locale): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();


            $phone = new TelephoneNumber($booking->getTelephone());
            $booking->setTelephone($booking->getTelephone() . ', '.$phone->getCountry());

            $message = (new \Swift_Message('Nueva reserva en Vinales.taxi - '.$booking->getOrderNumber()))
                ->setFrom(['noreply@taxidriverscuba.com'=>'TaxiDriversCuba'])
                ->setTo('taxidriverscuba@gmail.com')
                ->setBcc(['josmiguel92+vinales@gmail.com', '14ndy15+vinales@gmail.com'])
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'emails/bookingNotification.html.twig',
                        ['booking' => $booking]
                    ),
                    'text/html',
                    'UTF-8'
                )
                ->addPart(
                    $this->renderView(
                        'emails/bookingNotification.txt.twig',
                        ['booking' => $booking]
                    ),
                    'text/plain',
                    'UTF-8'
                );

            $mailer->send($message);

            if($booking->differenceTimeGreaterThan12Hours())
            {
                $messageToClient = (new \Swift_Message(($booking->getBookingLang() == 'es' ? 'Reserva en Vinales.taxi' : 'Booking on Vinales.Taxi').' - '.$booking->getOrderNumber()))
                    ->setFrom(['noreply@taxidriverscuba.com'=>'TaxiDriversCuba'])
                    ->setTo($booking->getClientEmail())
                    ->setBcc(['josmiguel92+vinales@gmail.com', '14ndy15+vinales@gmail.com'])


                    ->setBody(
                        $this->renderView(
                            'emails/clients/clientNotificationOnBooking.html.twig',
                            //      'api/bookingPdfExport.html.twig',
                            ['booking' => $booking]
                        ),
                        'text/html',
                        'UTF-8'
                    )
                    ->addPart(
                        $this->renderView(
                            'emails/clients/clientNotificationOnBooking.txt.twig',
                            ['booking' => $booking]
                        ),
                        'text/plain',
                        'UTF-8'
                    )
                ;
                $mailer->send($messageToClient);
            }

            return $this->redirectToRoute('booking_confirmation',
                ['orderNumber'=>$booking->getOrderNumber(), '_locale'=> $_locale]);
        }

        return $this->render('frontend/booking.html.twig', [
            'controller_name' => 'FrontendController',
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/backend/booking/new", name="backend_booking_new", methods={"GET","POST"})
     */
    public function backend_new(Request $request,
                         \Swift_Mailer $mailer): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();



            return $this->redirectToRoute('booking_index');
        }

            return $this->render('backend/booking/new.html.twig', [
                'booking' => $booking,
                'form' => $form->createView(),
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


    /**
     * @Route("/backend/booking/{id}", name="booking_show", methods={"GET"})
     */
    public function show(Booking $booking): Response
    {
        return $this->render('backend/booking/show.html.twig', [
            'booking' => $booking,
        ]);
    }

    /**
     * @Route("/backend/booking/{orderNumber}/pdf", name="booking_pdf_export", methods={"GET"})
     */
    public function pdfExport(Booking $booking): Response
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->set_option('dpi', 120);



        $dompdf->loadHtml(
            $this->renderView('emails/clientNotificationOnBooking.html.twig', array(
                'booking' => $booking,
            ))
        );


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        $filename = $booking->getOrderNumber().'.pdf';
        // Output the generated PDF to Browser
        return $dompdf->stream($filename);

    }
    /**
     * @Route("/backend/booking/{id}/edit", name="booking_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Booking $booking): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('booking_index', [
                'id' => $booking->getId(),
            ]);
        }

        return $this->render('backend/booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/backend/booking/{id}", name="booking_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Booking $booking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($booking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('booking_edit');
    }
}
