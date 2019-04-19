<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

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
     * @ORM\Column(type="datetime", length=255)
     */
    private $datedebut;

    /**
     * @ORM\Column(type="datetime", length=255)
     */
    private $datefin;









    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel", inversedBy="offres")
     */
    private $hotel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Agence", inversedBy="offre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;



    public function __construct()
    {


        $this->agence = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebut(): ?datetime
    {
//        $date = \DateTime::createFromFormat('d/m/Y', $this->datedebut);
//        if (!empty($date)) {
//            return $date;
//        }
        return $this->datedebut;
    }

    public function setDatedebut(datetime $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?datetime
    {
        return $this->datefin;
    }

    public function setDatefin(datetime $datefin): self
    {
//        $date = \DateTime::createFromFormat('d/m/Y', $this->datefin);
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







    public function getHotel()
    {
        return $this->hotel;
    }

    public function setHotel(?hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }

    public function getAgence()
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }







}
