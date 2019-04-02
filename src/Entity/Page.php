<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
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
    private $typepage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titrepage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypepage(): ?string
    {
        return $this->typepage;
    }

    public function setTypepage(string $typepage): self
    {
        $this->typepage = $typepage;

        return $this;
    }

    public function getTitrepage(): ?string
    {
        return $this->titrepage;
    }

    public function setTitrepage(string $titrepage): self
    {
        $this->titrepage = $titrepage;

        return $this;
    }
}
