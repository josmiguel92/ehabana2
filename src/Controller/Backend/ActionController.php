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
     * @Route("/action/approving_booking/{uniqueToken}/{action}", name="action_approving",
     *   requirements={"action": "approve|disapprove"})
     */
    public function action_approving(Booking $booking, string $action)
    {
        if($booking and !$booking->getActionTaken())
        {
            $action = $action === 'approve' ? $booking::ACTION_APPROVED_BOOKING : $booking::ACTION_DISAPPROVE_BOOKING;
            $booking->setActionTaken($action);
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            //TODO: dispatch a menssage to admin
            //TODO: dispatch a menssage to client

//          $this->renderView(
//            'emails/clients/clientNotificationOnBookingApproval.html.twig',
//            ['booking' => $booking]
//          ),

//          $this->renderView(
//            'emails/clients/clientNotificationOnBookingDisapproval.html.twig',
//            ['booking' => $booking]
//          ),

            return $this->render('backend/actions/actionResponse.html.twig', [
                'action' => "La reserva fue $action. Se le ha enviado un email al cliente.",
            ]);
        }

        return $this->render('backend/actions/actionResponse.html.twig', [
            'action' => 'Este enlace ya fue procesado y ya no en válido.',
        ]);
    }

}
