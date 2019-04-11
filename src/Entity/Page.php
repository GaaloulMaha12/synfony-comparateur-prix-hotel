<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Element", mappedBy="page")
     */
    private $element;

    public function __construct()
    {
        $this->element = new ArrayCollection();
    }

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

    /**
     * @return Collection|element[]
     */
    public function getElement(): Collection
    {
        return $this->element;
    }

    public function addElement(element $element): self
    {
        if (!$this->element->contains($element)) {
            $this->element[] = $element;
            $element->setPage($this);
        }

        return $this;
    }

    public function removeElement(element $element): self
    {
        if ($this->element->contains($element)) {
            $this->element->removeElement($element);
            // set the owning side to null (unless already changed)
            if ($element->getPage() === $this) {
                $element->setPage(null);
            }
        }

        return $this;
    }
}
