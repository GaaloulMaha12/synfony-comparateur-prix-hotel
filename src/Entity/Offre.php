<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OffreRepository")
 */
class Offre
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
    private $nomoffre;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $datedebut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $datefin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\chambre", mappedBy="offre")
     */
    private $chambre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\pension", inversedBy="offres")
     */
    private $pension;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\tarif", mappedBy="offre")
     */
    private $tarif;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\agence", mappedBy="offre")
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\hotel", inversedBy="offres")
     */
    private $hotel;




    public function __construct()
    {
        $this->chambre = new ArrayCollection();
        $this->tarif = new ArrayCollection();
        $this->agence = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebut(): ?string
    {
        return $this->datedebut;
    }

    public function setDatedebut(string $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?string
    {
        return $this->datefin;
    }

    public function setDatefin(string $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getNomoffre(): ?string
    {
        return $this->nomoffre;
    }

    public function setNomoffre(string $nomoffre): self
    {
        $this->nomoffre= $nomoffre;

        return $this;
    }

    /**
     * @return Collection|chambre[]
     */
    public function getChambre(): Collection
    {
        return $this->chambre;
    }

    public function addChambre(chambre $chambre): self
    {
        if (!$this->chambre->contains($chambre)) {
            $this->chambre[] = $chambre;
            $chambre->setOffre($this);
        }

        return $this;
    }

    public function removeChambre(chambre $chambre): self
    {
        if ($this->chambre->contains($chambre)) {
            $this->chambre->removeElement($chambre);
            // set the owning side to null (unless already changed)
            if ($chambre->getOffre() === $this) {
                $chambre->setOffre(null);
            }
        }

        return $this;
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

    public function getPension(): ?pension
    {
        return $this->pension;
    }

    public function setPension(?pension $pension): self
    {
        $this->pension = $pension;

        return $this;
    }

    /**
     * @return Collection|tarif[]
     */
    public function getTarif(): Collection
    {
        return $this->tarif;
    }

    public function addTarif(tarif $tarif): self
    {
        if (!$this->tarif->contains($tarif)) {
            $this->tarif[] = $tarif;
            $tarif->setOffre($this);
        }

        return $this;
    }

    public function removeTarif(tarif $tarif): self
    {
        if ($this->tarif->contains($tarif)) {
            $this->tarif->removeElement($tarif);
            // set the owning side to null (unless already changed)
            if ($tarif->getOffre() === $this) {
                $tarif->setOffre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|agence[]
     */
    public function getAgence(): Collection
    {
        return $this->agence;
    }

    public function addAgence(agence $agence): self
    {
        if (!$this->agence->contains($agence)) {
            $this->agence[] = $agence;
            $agence->setOffre($this);
        }

        return $this;
    }

    public function removeAgence(agence $agence): self
    {
        if ($this->agence->contains($agence)) {
            $this->agence->removeElement($agence);
            // set the owning side to null (unless already changed)
            if ($agence->getOffre() === $this) {
                $agence->setOffre(null);
            }
        }

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
