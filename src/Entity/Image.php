<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
    private $imagehotel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagehotel(): ?string
    {
        return $this->imagehotel;
    }

    public function setImagehotel(string $imagehotel): self
    {
        $this->imagehotel = $imagehotel;

        return $this;
    }

    public function getHotel(): ?hotel
    {
        return $this->hotel;
    }

    public function setHotel(?hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }
}
