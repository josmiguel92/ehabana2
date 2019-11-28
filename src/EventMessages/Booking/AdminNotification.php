<?php


namespace App\EventMessages\Booking;


use App\Entity\Booking;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\RouterInterface;

class AdminNotification
{
    private $booking;
    public const ADMIN_EMAIL_ADDRESS = 'elizaldebarrestaurante@gmail.com';
    public const ADMIN_EMAIL_ADDRESS_COPY = 'josmiguel92+elizalde@gmail.com';
  /**
   * @var RouterInterface
   */
  private $router;

  /**
   * AdminNotification constructor.
   * @param Booking $booking
   * @param RouterInterface $router
   */
  public function __construct(Booking $booking, RouterInterface $router)
  {
    $this->booking = $booking;
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

    $email = (new NotificationEmail())
      ->to(self::ADMIN_EMAIL_ADDRESS)
      ->cc(self::ADMIN_EMAIL_ADDRESS_COPY)
      ->subject('Nueva reserva en ElizaldeHabana')
      ->markdown(<<<EOF
Recientemente alguien reservó en ElizaldeHabana.

Su nombre es **$clientName**, su email es **[$clientEmail](mailto:$clientEmail)**.

La reserva fue fijada para el día y hora **$bookingDate**, para **$persons personas**

Sus comentarios:

  *``$clientComment``*

...

Campaña: * $campaign *.
EOF
      )
      ->action('Ver los detalles', $this->router->generate('easyadmin', [
        'entity'=> 'Booking',
        'action' => 'show',
        'id' => $this->booking->getId()
      ], 0) )
      ->importance(NotificationEmail::IMPORTANCE_HIGH)
    ;

    return $email;
  }


}
