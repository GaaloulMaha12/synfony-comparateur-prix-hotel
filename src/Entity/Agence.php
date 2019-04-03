<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgenceRepository")
 */
class Agence
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
    private $nom_agence;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private  $lien_agence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offre", inversedBy="agence")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offre;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAgence(): ?string
    {
        return $this->nom_agence;
    }

    public function setNomAgence(string $nom_agence): self
    {
        $this->nom_agence = $nom_agence;

        return $this;
    }
    public function getLienAgence(): ?string
    {
        return $this->lien_agence;
    }

    public function setLienAgence(string $lien_agence): self
    {
        $this->lien_agence = $lien_agence;

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
