<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HomeTextRepository")
 */
class HomeText
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TituloPrincipalEs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TituloPrincipalEn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SubtituloPrincipalEs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SubtituloPrincipalEn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SobreNosotrosTituloEs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SobreNosotrosTituloEn;

    /**
     * @ORM\Column(type="text")
     */
    private $SobreNosotrosTextoEs;

    /**
     * @ORM\Column(type="text")
     */
    private $SobreNosotrosTextoEn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $VideoLink;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ReservaTituloEs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ReservaTituloEn;

    /**
     * @ORM\Column(type="text")
     */
    private $ReservaTextoEs;

    /**
     * @ORM\Column(type="text")
     */
    private $ReservaTextoEn;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTituloPrincipalEs(): ?string
    {
        return $this->TituloPrincipalEs;
    }

    public function getTituloPrincipal($locale): ?string
    {
      if($locale === 'es')
        return $this->TituloPrincipalEs;
      return $this->TituloPrincipalEn;
    }

    public function setTituloPrincipalEs(string $TituloPrincipalEs): self
    {
        $this->TituloPrincipalEs = $TituloPrincipalEs;

        return $this;
    }

    public function getTituloPrincipalEn(): ?string
    {
        return $this->TituloPrincipalEn;
    }

    public function setTituloPrincipalEn(string $TituloPrincipalEn): self
    {
        $this->TituloPrincipalEn = $TituloPrincipalEn;

        return $this;
    }

    public function getSubtituloPrincipalEs(): ?string
    {
        return $this->SubtituloPrincipalEs;
    }

    public function getSubtituloPrincipal($locale): ?string
    {
        if($locale === 'es')
        return $this->SubtituloPrincipalEs;
        return  $this->SubtituloPrincipalEn;
    }

    public function setSubtituloPrincipalEs(string $SubtituloPrincipalEs): self
    {
        $this->SubtituloPrincipalEs = $SubtituloPrincipalEs;

        return $this;
    }

    public function getSubtituloPrincipalEn(): ?string
    {
        return $this->SubtituloPrincipalEn;
    }

    public function setSubtituloPrincipalEn(string $SubtituloPrincipalEn): self
    {
        $this->SubtituloPrincipalEn = $SubtituloPrincipalEn;

        return $this;
    }

    public function getSobreNosotrosTituloEs(): ?string
    {
        return $this->SobreNosotrosTituloEs;
    }
    public function getSobreNosotrosTitulo($locale): ?string
    {
      if($locale === 'es')
        return $this->SobreNosotrosTituloEs;
        return $this->SobreNosotrosTituloEn;
    }

    public function setSobreNosotrosTituloEs(string $SobreNosotrosTituloEs): self
    {
        $this->SobreNosotrosTituloEs = $SobreNosotrosTituloEs;

        return $this;
    }

    public function getSobreNosotrosTituloEn(): ?string
    {
        return $this->SobreNosotrosTituloEn;
    }

    public function setSobreNosotrosTituloEn(string $SobreNosotrosTituloEn): self
    {
        $this->SobreNosotrosTituloEn = $SobreNosotrosTituloEn;

        return $this;
    }

    public function getSobreNosotrosTextoEs(): ?string
    {
        return $this->SobreNosotrosTextoEs;
    }
    public function getSobreNosotrosTexto($locale): ?string
    {
      if($locale === 'es')
        return $this->SobreNosotrosTextoEs;
        return $this->SobreNosotrosTextoEn;
    }

    public function setSobreNosotrosTextoEs(string $SobreNosotrosTextoEs): self
    {
        $this->SobreNosotrosTextoEs = $SobreNosotrosTextoEs;

        return $this;
    }

    public function getSobreNosotrosTextoEn(): ?string
    {
        return $this->SobreNosotrosTextoEn;
    }

    public function setSobreNosotrosTextoEn(string $SobreNosotrosTextoEn): self
    {
        $this->SobreNosotrosTextoEn = $SobreNosotrosTextoEn;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->VideoLink;
    }

    public function setVideoLink(?string $VideoLink): self
    {
        $this->VideoLink = $VideoLink;

        return $this;
    }

    public function getReservaTituloEs(): ?string
    {
        return $this->ReservaTituloEs;
    }
    public function getReservaTitulo($locale): ?string
    {
      if($locale === 'es')
        return $this->ReservaTituloEs;
        return $this->ReservaTituloEn;

    }

    public function setReservaTituloEs(string $ReservaTituloEs): self
    {
        $this->ReservaTituloEs = $ReservaTituloEs;

        return $this;
    }

    public function getReservaTituloEn(): ?string
    {
        return $this->ReservaTituloEn;
    }

    public function setReservaTituloEn(string $ReservaTituloEn): self
    {
        $this->ReservaTituloEn = $ReservaTituloEn;

        return $this;
    }

    public function getReservaTextoEs(): ?string
    {
        return $this->ReservaTextoEs;
    }

    public function getReservaTexto($locale): ?string
    {
      if($locale === 'es')
        return $this->ReservaTextoEs;
        return $this->ReservaTextoEn;
    }

    public function setReservaTextoEs(string $ReservaTextoEs): self
    {
        $this->ReservaTextoEs = $ReservaTextoEs;

        return $this;
    }

    public function getReservaTextoEn(): ?string
    {
        return $this->ReservaTextoEn;
    }

    public function setReservaTextoEn(string $ReservaTextoEn): self
    {
        $this->ReservaTextoEn = $ReservaTextoEn;

        return $this;
    }
}
