<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HotelRepository")
 */
class Hotel
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
    private $nomhotel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $positionhotel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typehotel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $service;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomhotel(): ?string
    {
        return $this->nomhotel;
    }

    public function setNomhotel(string $nomhotel): self
    {
        $this->nomhotel = $nomhotel;

        return $this;
    }

    public function getPositionhotel(): ?string
    {
        return $this->positionhotel;
    }

    public function setPositionhotel(string $positionhotel): self
    {
        $this->positionhotel = $positionhotel;

        return $this;
    }

    public function getTypehotel(): ?string
    {
        return $this->typehotel;
    }

    public function setTypehotel(string $typehotel): self
    {
        $this->typehotel = $typehotel;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }
}
