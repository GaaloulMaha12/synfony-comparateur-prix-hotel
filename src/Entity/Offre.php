<?php

namespace App\Entity;

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
     * @ORM\Column(type="date", length=255)
     */
    private $datedebut;

    /**
     * @ORM\Column(type="date", length=255)
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Chambre", inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chambre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tariflocal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoriechambre", inversedBy="offres")
     */
    private $categoriechambre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lienoffre;







    public function __construct()
    {


        $this->agence = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebut(): ?date
    {
        $date = \DateTime::createFromFormat('d/m/Y', $this->datedebut);
        if (!empty($date)) {
            return $date;
        }
        return null;
    }

    public function setDatedebut(date $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?date
    {
        return $this->datefin;
    }

    public function setDatefin(date $datefin): self
    {
        $date = \DateTime::createFromFormat('d/m/Y', $this->datefin);

        return $date;
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





    public function getPension()
    {
        return $this->pension;
    }

    public function setPension(?pension $pension): self
    {
        $this->pension = $pension;

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


    public function getChambre()
    {
        return $this->chambre;
    }

    public function setChambre(?chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    public function getTariflocal(): ?string
    {
        return $this->tariflocal;
    }

    public function setTariflocal(string $tariflocal): self
    {
        $this->tariflocal = $tariflocal;

        return $this;
    }

    public function getCategoriechambre(): ?categoriechambre
    {
        return $this->categoriechambre;
    }

    public function setCategoriechambre(?categoriechambre $categoriechambre): self
    {
        $this->categoriechambre = $categoriechambre;

        return $this;
    }

    public function getLienoffre(): ?string
    {
        return $this->lienoffre;
    }

    public function setLienoffre(string $lienoffre): self
    {
        $this->lienoffre = $lienoffre;

        return $this;
    }







}
