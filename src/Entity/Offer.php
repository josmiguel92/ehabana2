<?php

namespace App\Entity;

use App\Entity\Traits\ImageFieldTrait;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
  * @Vich\Uploadable
 */
class Offer
{
  use ImageFieldTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titleEs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $textEs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titleEn;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $textEn;

    public function getId(): ?int
    {
        return $this->id;
    }

  /**
   * @return mixed
   */
  public function getTitleEs()
  {
    return $this->titleEs;
  }

  /**
   * @param mixed $titleEs
   */
  public function setTitleEs($titleEs): void
  {
    $this->titleEs = $titleEs;
  }

  /**
   * @return mixed
   */
  public function getTextEs()
  {
    return $this->textEs;
  }

  /**
   * @param mixed $textEs
   */
  public function setTextEs($textEs): void
  {
    $this->textEs = $textEs;
  }

  /**
   * @return mixed
   */
  public function getTitleEn()
  {
    return $this->titleEn;
  }


  /**
   * @return mixed
   */
  public function getTitle($locale)
  {
    if($locale === 'es')
      return $this->titleEs;
    return $this->titleEn;
  }
  /**
   * @param mixed $titleEn
   */
  public function setTitleEn($titleEn): void
  {
    $this->titleEn = $titleEn;
  }

  /**
   * @return mixed
   */
  public function getTextEn()
  {
    return $this->textEn;
  }

  /**
   * @return mixed
   */
  public function getText($locale)
  {
    if($locale === 'es')
      return $this->textEs;
    return $this->textEn;
  }
  /**
   * @param mixed $textEn
   */
  public function setTextEn($textEn): void
  {
    $this->textEn = $textEn;
  }



}
