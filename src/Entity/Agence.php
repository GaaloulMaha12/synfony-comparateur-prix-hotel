<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity="App\Entity\Offre", mappedBy="agence")
     */
    private $offre;

    public function __construct()
    {
        $this->offre = new ArrayCollection();
    }




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

    /**
     * @return Collection|offre[]
     */
    public function getOffre(): Collection
    {
        return $this->offre;
    }

    public function addOffre(offre $offre): self
    {
        if (!$this->offre->contains($offre)) {
            $this->offre[] = $offre;
            $offre->setAgence($this);
        }

        return $this;
    }

    public function removeOffre(offre $offre): self
    {
        if ($this->offre->contains($offre)) {
            $this->offre->removeElement($offre);
            // set the owning side to null (unless already changed)
            if ($offre->getAgence() === $this) {
                $offre->setAgence(null);
            }
        }

        return $this;
    }

}
