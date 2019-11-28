<?php
/**
 * @author Josue Miguel <josmigue92@gmail.com>
 */

namespace App\EventMessages\Booking;

use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

class NewBookingHandler implements MessageHandlerInterface
{

  private $mailer;
  private $booking;

  /**
   * @var RouterInterface
   */
  private $router;
  /**
   * @var TranslatorInterface
   */
  private $translator;

  public function __construct(MailerInterface $mailer, RouterInterface $router, TranslatorInterface $translator)
  {
    $this->mailer = $mailer;
    $this->router = $router;
    $this->translator = $translator;
  }

  public function __invoke(NewBookingMsg $bookingMsg)
  {
    $this->booking = $bookingMsg->booking;

    $adminEmail = new AdminNotification($this->booking, $this->router);
    $this->mailer->send($adminEmail->getEmail());

    $clientEmail = new ClientNotification($this->booking, $this->translator, $this->router);
    $this->mailer->send($clientEmail->getEmail());


  }


}
