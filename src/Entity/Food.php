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
}
