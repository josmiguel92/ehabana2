<?php
/**
 * @author Josue Miguel <josmigue92@gmail.com>
 */

namespace App\EventMessages\Booking;


use App\Entity\Booking;

class NewBookingMsg
{
  public $booking;

  public function __construct(Booking $booking = null)
  {
    $this->booking = $booking;
  }

}
