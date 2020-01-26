<?php

namespace App\Entity;

use App\Entity\Traits\ImageFieldTrait;
use App\Entity\Traits\TranslatableTrait;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FoodRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Food
{
    use ImageFieldTrait, TranslatableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $name;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $ingredients;

    /**
     * @ORM\Column(type="decimal", nullable=true)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function setIngredients($ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function setNameEs($nameEs): void
    {
      $tmp = json_decode($this->name, true);
      $tmp['es'] = $nameEs;
      $this->name = json_encode($tmp);
    }

    public function setNameEn($nameEn): void
    {
      $tmp = json_decode($this->name, true);
      $tmp['en'] = $nameEn;
      $this->name = json_encode($tmp);
    }

    public function setIngredientsEs($txtEs): void
    {
      $tmp = json_decode($this->ingredients, true);
      $tmp['es'] = $txtEs;
      $this->ingredients = json_encode($tmp);
    }

    public function setIngredientsEn($txtEn): void
    {
      $tmp = json_decode($this->ingredients, true);
      $tmp['en'] = $txtEn;
      $this->ingredients = json_encode($tmp);
    }

    public function getNameEs(): ?string
    {
      $tmp = json_decode($this->name, true);
      return $tmp['es'] ?? null;
    }

    public function getNameEn(): ?string
    {
      $tmp = json_decode($this->name, true);
      return $tmp['en'] ?? null;
    }

    public function getIngredientsEs(): ?string
    {
      $tmp = json_decode($this->ingredients, true);
      return $tmp['es'] ?? null;
    }

    public function getIngredientsEn(): ?string
    {
      $tmp = json_decode($this->ingredients, true);
      return $tmp['en'] ?? null;
    }
}
