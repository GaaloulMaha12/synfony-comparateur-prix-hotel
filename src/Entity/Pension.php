<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PensionRepository")
 */
class Pension
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
    private $typepension;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Detailsoffre", mappedBy="pension")
     */
    private $detailsoffres;










    public function __construct()
    {
        $this->offres = new ArrayCollection();
        $this->detailsoffres = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypepension(): ?string
    {
        return $this->typepension;
    }

    public function setTypepension(string $typepension): self
    {
        $this->typepension = $typepension;

        return $this;
    }

    /**
     * @return Collection|Detailsoffre[]
     */
    public function getDetailsoffres(): Collection
    {
        return $this->detailsoffres;
    }

    public function addDetailsoffre(Detailsoffre $detailsoffre): self
    {
        if (!$this->detailsoffres->contains($detailsoffre)) {
            $this->detailsoffres[] = $detailsoffre;
            $detailsoffre->setPension($this);
        }

        return $this;
    }

    public function removeDetailsoffre(Detailsoffre $detailsoffre): self
    {
        if ($this->detailsoffres->contains($detailsoffre)) {
            $this->detailsoffres->removeElement($detailsoffre);
            // set the owning side to null (unless already changed)
            if ($detailsoffre->getPension() === $this) {
                $detailsoffre->setPension(null);
            }
        }

        return $this;
    }











}
