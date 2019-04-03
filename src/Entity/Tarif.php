<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TarifRepository")
 */
class Tarif
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
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pension", inversedBy="tarif")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Pension;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pension", mappedBy="tarif")
     */
    private $pensions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chambre", mappedBy="tarif")
     */
    private $chambres;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offre", inversedBy="tarif")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offre;



    public function __construct()
    {
        $this->pensions = new ArrayCollection();
        $this->chambres = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPension(): ?Pension
    {
        return $this->Pension;
    }

    public function setPension(?Pension $Pension): self
    {
        $this->Pension = $Pension;

        return $this;
    }

    /**
     * @return Collection|Pension[]
     */
    public function getPensions(): Collection
    {
        return $this->pensions;
    }

    public function addPension(Pension $pension): self
    {
        if (!$this->pensions->contains($pension)) {
            $this->pensions[] = $pension;
            $pension->setTarif($this);
        }

        return $this;
    }

    public function removePension(Pension $pension): self
    {
        if ($this->pensions->contains($pension)) {
            $this->pensions->removeElement($pension);
            // set the owning side to null (unless already changed)
            if ($pension->getTarif() === $this) {
                $pension->setTarif(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Chambre[]
     */
    public function getChambres(): Collection
    {
        return $this->chambres;
    }

    public function addChambre(Chambre $chambre): self
    {
        if (!$this->chambres->contains($chambre)) {
            $this->chambres[] = $chambre;
            $chambre->setTarif($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): self
    {
        if ($this->chambres->contains($chambre)) {
            $this->chambres->removeElement($chambre);
            // set the owning side to null (unless already changed)
            if ($chambre->getTarif() === $this) {
                $chambre->setTarif(null);
            }
        }

        return $this;
    }

    public function getOffre(): ?Offre
    {
        return $this->offre;
    }

    public function setOffre(?Offre $offre): self
    {
        $this->offre = $offre;

        return $this;
    }




}
