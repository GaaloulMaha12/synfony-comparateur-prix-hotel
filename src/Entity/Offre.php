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
     * @ORM\ManyToOne(targetEntity="App\Entity\Pension", inversedBy="offres")
     */
    private $pension;




    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="offres")
     */
    private $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Agence", inversedBy="offre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tarif", mappedBy="offre")
     */
    private $tarif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chambre", inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chambre;




    public function __construct()
    {

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





    public function getPension(): ?pension
    {
        return $this->pension;
    }

    public function setPension(?pension $pension): self
    {
        $this->pension = $pension;

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

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

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

    public function getChambre(): ?chambre
    {
        return $this->chambre;
    }

    public function setChambre(?chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }



}
