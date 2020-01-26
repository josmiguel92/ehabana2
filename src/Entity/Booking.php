<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Booking
{

    CONST ACTION_APPROVED_BOOKING = 'APROBADA';
    CONST ACTION_DISAPPROVE_BOOKING = 'DESAPROBADA';
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $campaign;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clientName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid one."
     * )
     *  @Assert\NotBlank
     */
    private $clientEmail;


    /**
     * @ORM\Column(type="datetime")
     * @Assert\GreaterThanOrEqual(Booking::DATE_TO_START_BOOKINGS)
     */
    private $bookingDateTime;
    const DATE_TO_START_BOOKINGS = "now + 12 hours";

        //to temporary store the user input
    private $bookingDate;
    private $bookingTime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bookingLang;

    /**
     * @ORM\Column(type="integer")
     */
    private $peopleCount;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orderNumber;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $actionTaken;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $uniqueToken;


    /**
     * @ORM\Column(type="boolean")
     */
    private $UserConfirmed;


    /**
     * @ORM\Column(type="boolean")
     */
    private $IsDone;

    /**
     * @return mixed
     */
    public function getClientMessage()
    {
        return $this->clientMessage;
    }

    /**
     * @param mixed $clientMessage
     */
    public function setClientMessage($clientMessage): void
    {
        $this->clientMessage = $clientMessage;
    }

    /**
     * @ORM\Column(type="string", length=600, nullable=true)
     */
    private $clientMessage;



    public function __construct()
    {
        $this->creationDate = new \DateTime();
        $this->orderNumber = "el-".date("md")."-".substr(uniqid('', true),8,4);
        $this->uniqueToken = uniqid('', true);
        $this->setUserConfirmed(false);
        $this->setIsDone(false);

    }


    public function getId(): ?int
    {
        return $this->id;
    }



    public function getCampaign(): ?string
    {
        return $this->campaign;
    }

    public function setCampaign(?string $campaign): self
    {
        $this->campaign = $campaign;

        return $this;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): self
    {
        $this->clientName = $clientName;

        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(string $clientEmail): self
    {
        $this->clientEmail = $clientEmail;

        return $this;
    }

    public function getBookingLang(): ?string
    {
        return $this->bookingLang;
    }

    public function setBookingLang(?string $bookingLang): self
    {
        $this->bookingLang = $bookingLang;

        return $this;
    }


    public function getPeopleCount(): ?int
    {
        return $this->peopleCount;
    }

    public function setPeopleCount(int $peopleCount): self
    {
        $this->peopleCount = $peopleCount;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(string $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getUserConfirmed(): ?bool
    {
        return $this->UserConfirmed;
    }

    public function setUserConfirmed(bool $UserConfirmed): self
    {
        $this->UserConfirmed = $UserConfirmed;

        return $this;
    }


    public function getIsDone(): ?bool
    {
        return $this->IsDone;
    }

    public function setIsDone(bool $IsDone): self
    {
        $this->IsDone = $IsDone;

        return $this;
    }

    public function differenceTimeGreaterThan12Hours(): bool
    {
        $diff = $this->creationDate->diff($this->bookingDateTime);
        $hours = $diff->h;
        $hours = $hours + ($diff->days*24);

        return ($hours > 12);
    }

    /**
     * @return mixed
     */
    public function getUniqueToken()
    {
        return $this->uniqueToken;
    }

    /**
     * @param mixed $uniqueToken
     */
    public function setUniqueToken($uniqueToken): void
    {
        $this->uniqueToken = $uniqueToken;
    }

    /**
     * @return mixed
     */
    public function getActionTaken()
    {
        return $this->actionTaken;
    }

    /**
     * @param mixed $actionTaken
     */
    public function setActionTaken($actionTaken): void
    {
        $this->actionTaken = $actionTaken;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getBookingDateTime()
    {
        return $this->bookingDateTime;
    }

    /**
     * @param mixed $bookingDateTime
     */
    public function setBookingDateTime($bookingDateTime): void
    {
        $this->bookingDateTime = $bookingDateTime;
    }

    public function getBookingDate(): ?\DateTimeInterface
    {
        return $this->bookingDate;
    }

    public function setBookingDate(?\DateTimeInterface $bookingDate): self
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    public function getBookingTime(): ?\DateTimeInterface
    {
        return $this->bookingTime;
    }

    public function setBookingTime(?\DateTimeInterface $bookingTime): self
    {
        $this->bookingTime = $bookingTime;

        return $this;
    }

}
