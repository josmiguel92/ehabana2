<?php

namespace App\Controller\Backend;

use App\Entity\Booking;
use Liip\ImagineBundle\Exception\Config\Filter\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface as Translator;
use Symfony\Component\Routing\Annotation\Route;

class ActionController extends AbstractController
{
    //TODO: Adopt
    /**
     * @Route("/action/approve_booking/{uniqueToken}", name="action_approve_booking")
     */
    public function approveBooking(Booking $booking,  \Swift_Mailer $mailer, Translator $translator)
    {
        if($booking and !$booking->getActionTaken())
        {
            $booking->setActionTaken($booking::ACTION_APPROVED_BOOKING);
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            //mensaje a admin
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

            // Save the current session locale
            // before overwriting it. Suppose its 'en_US'
            $sessionLocale = $translator->getLocale();

            $translator->setLocale($booking->getBookingLang());

            $subject = $translator->trans('approved_booking_email_subject');

            $client_message = (new \Swift_Message($subject . ' - '. $booking->getOrderNumber() . ' | Vinales.taxi'))
                ->setFrom(['noreply@taxidriverscuba.com'=>'TaxiDriversCuba'])
                ->setTo($booking->getClientEmail())
                ->setBcc(['josmiguel92+vinales@gmail.com', '14ndy15+vinales@gmail.com'])
                ->setBody(
                    $this->renderView(
                        'emails/clients/clientNotificationOnBookingApproval.html.twig',
                        ['booking' => $booking]
                    ),
                    'text/html',
                    'UTF-8'
                )
                ->addPart(
                    $this->renderView(
                        'emails/clients/clientNotificationOnBookingApproval.txt.twig',
                        ['booking' => $booking]
                    ),
                    'text/plain',
                    'UTF-8'
                );

            $mailer->send($client_message);

            $translator->setLocale($sessionLocale);

            return $this->render('backend/actions/actionResponse.html.twig', [
                'action' => 'La reserva fue aceptada. Se le ha enviado un email al cliente.',
            ]);
        }

        return $this->render('backend/actions/actionResponse.html.twig', [
            'action' => 'Este enlace ya fue procesado y ya no en válido.',
        ]);
    }

    /**
     * @Route("/action/disapprove_booking/{uniqueToken}", name="action_disapprove_booking")
     */
    public function disapproveBooking(Booking $booking,  \Swift_Mailer $mailer, Translator $translator)
    {
        if($booking and !$booking->getActionTaken())
        {
            $booking->setActionTaken($booking::ACTION_DISAPPROVE_BOOKING);
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            // Save the current session locale
            // before overwriting it. Suppose its 'en_US'
            $sessionLocale = $translator->getLocale();

            $translator->setLocale($booking->getBookingLang());

            $subject = $translator->trans('disapproved_booking_email_subject');

            $client_message = (new \Swift_Message($subject . ' - '. $booking->getOrderNumber() . ' | Vinales.taxi'))
                ->setFrom(['noreply@taxidriverscuba.com'=>'TaxiDriversCuba'])
                ->setTo($booking->getClientEmail())
                ->setBcc(['josmiguel92+vinales@gmail.com', '14ndy15+vinales@gmail.com'])
                ->setBody(
                    $this->renderView(
                        'emails/clients/clientNotificationOnBookingDisapproval.html.twig',
                        ['booking' => $booking]
                    ),
                    'text/html',
                    'UTF-8'
                )
                ->addPart(
                    $this->renderView(
                        'emails/clients/clientNotificationOnBookingDisapproval.txt.twig',
                        ['booking' => $booking]
                    ),
                    'text/plain',
                    'UTF-8'
                );

            $mailer->send($client_message);

            $translator->setLocale($sessionLocale);

            return $this->render('backend/actions/actionResponse.html.twig', [
                'action' => 'Como indicó, la reserva no fue aceptada. Se le ha enviado un email al cliente.',
            ]);
        }

        return $this->render('backend/actions/actionResponse.html.twig', [
            'action' => 'Este enlace ya fue procesado y ya no en válido.',
        ]);
    }
}
