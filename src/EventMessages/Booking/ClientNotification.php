<?php


namespace App\EventMessages\Booking;


use App\Entity\Booking;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ClientNotification
{
    private $booking;
    private $email;
    private $translator;
  /**
   * @var RouterInterface
   */
  private $router;

  /**
   * AdminNotification constructor.
   * @param Booking $booking
   * @param TranslatorInterface $translator
   */
  public function __construct(Booking $booking, TranslatorInterface $translator, RouterInterface $router)
  {
    $this->booking = $booking;
    $this->translator = $translator;
    $this->router = $router;
  }

  public function getEmail():Email
  {
    $clientEmail = $this->booking->getClientEmail();
    $clientName = $this->booking->getClientName();
    $bookingDate = $this->booking->getBookingDateTime()->format('Y-m-d H:i');
    $persons = $this->booking->getPeopleCount();
    $clientComment = $this->booking->getClientMessage();
    $campaign = $this->booking->getCampaign();

    $subject = $this->translator->trans(
      'email.client.booking.subject',
      [],
      'messages',
      $this->booking->getBookingLang()
    );
//
    $email = (new TemplatedEmail())
      ->to($clientEmail)
      ->replyTo(AdminNotification::ADMIN_EMAIL_ADDRESS)
      ->subject($subject)
      ->htmlTemplate('emails/clients/clientNotificationOnBooking.html.twig')
      ->context(
        [
          'booking' => $this->booking,
          'confirm_url' => $this->router->generate(
            'booking_confirmation',
            [
              '_locale' => $this->booking->getBookingLang(),
              'orderNumber' =>$this->booking->getOrderNumber()
            ],
            0
          )
        ]
      )
    ;

    return $email;
  }


}
