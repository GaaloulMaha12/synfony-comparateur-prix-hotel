<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity="App\Entity\Detailsoffre", mappedBy="chambre")
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

    public function getTypechambre(): ?string
    {
        return $this->typechambre;
    }

    public function setTypechambre(string $typechambre): self
    {
        $this->typechambre = $typechambre;

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
            $detailsoffre->setChambre($this);
        }

        return $this;
    }

    public function removeDetailsoffre(Detailsoffre $detailsoffre): self
    {
        if ($this->detailsoffres->contains($detailsoffre)) {
            $this->detailsoffres->removeElement($detailsoffre);
            // set the owning side to null (unless already changed)
            if ($detailsoffre->getChambre() === $this) {
                $detailsoffre->setChambre(null);
            }
        }

        return $this;
    }
}















