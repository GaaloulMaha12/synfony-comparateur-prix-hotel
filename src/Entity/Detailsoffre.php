<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetailsoffreRepository")
 */
class Detailsoffre
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
    private $type_chambre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie_chambre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_pension;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tarif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lien_offre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeChambre(): ?string
    {
        return $this->type_chambre;
    }

    public function setTypeChambre(string $type_chambre): self
    {
        $this->type_chambre = $type_chambre;

        return $this;
    }

    public function getCategorieChambre(): ?string
    {
        return $this->categorie_chambre;
    }

    public function setCategorieChambre(string $categorie_chambre): self
    {
        $this->categorie_chambre = $categorie_chambre;

        return $this;
    }

    public function getTypePension(): ?string
    {
        return $this->type_pension;
    }

    public function setTypePension(string $type_pension): self
    {
        $this->type_pension = $type_pension;

        return $this;
    }

    public function getTarif(): ?string
    {
        return $this->tarif;
    }

    public function setTarif(string $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getLienOffre(): ?string
    {
        return $this->lien_offre;
    }

    public function setLienOffre(string $lien_offre): self
    {
        $this->lien_offre = $lien_offre;

        return $this;
    }
}
