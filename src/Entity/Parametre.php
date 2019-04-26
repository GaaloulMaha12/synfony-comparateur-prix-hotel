<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParametreRepository")
 */
class Parametre
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
    private $nomparametre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeparametre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $valeurparametre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Administrateur", inversedBy="parametres")
     */
    private $administrateur;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomparametre(): ?string
    {
        return $this->nomparametre;
    }

    public function setNomparametre(string $nomparametre): self
    {
        $this->nomparametre = $nomparametre;

        return $this;
    }

    public function getTypeparametre(): ?string
    {
        return $this->typeparametre;
    }

    public function setTypeparametre(string $typeparametre): self
    {
        $this->typeparametre = $typeparametre;

        return $this;
    }

    public function getValeurparametre(): ?string
    {
        return $this->valeurparametre;
    }

    public function setValeurparametre(string $valeurparametre): self
    {
        $this->valeurparametre = $valeurparametre;

        return $this;
    }

    public function getAdministrateur(): ?administrateur
    {
        return $this->administrateur;
    }

    public function setAdministrateur(?administrateur $administrateur): self
    {
        $this->administrateur = $administrateur;

        return $this;
    }


}
