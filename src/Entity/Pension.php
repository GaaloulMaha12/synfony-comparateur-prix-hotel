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
     * @ORM\OneToMany(targetEntity="App\Entity\Offre", mappedBy="pension")
     */
    private $offres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tarif", inversedBy="pensions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tarif;



    public function __construct()
    {
        $this->offres = new ArrayCollection();
        $this->tarif = new ArrayCollection();
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
     * @return Collection|Offre[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->setPension($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            // set the owning side to null (unless already changed)
            if ($offre->getPension() === $this) {
                $offre->setPension(null);
            }
        }

        return $this;
    }

    public function getTarif(): ?tarif
    {
        return $this->tarif;
    }

    public function setTarif(?tarif $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }






}
