<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChambreRepository")
 */
class Chambre
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
    private $typechambre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomchambre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offre", inversedBy="chambre")
     */
    private $offre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\tarif", inversedBy="chambres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tarif;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypechambre(): ?string
    {
        return $this->typechambre;
    }

    public function setTypechambre(string $typechambre): self
    {
        $this->typechambre = $typechambre;

        return $this;
    }

    public function getNomchambre(): ?string
    {
        return $this->nomchambre;
    }

    public function setNomchambre(string $nomchambre): self
    {
        $this->nomchambre = $nomchambre;

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


