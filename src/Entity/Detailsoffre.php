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
    private $lien_offre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chambre", inversedBy="detailsoffres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chambre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pension", inversedBy="detailsoffres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pension;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoriechambre", inversedBy="detailsoffres")
     */
    private $categoriechambre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tarif;






    public function getId(): ?int
    {
        return $this->id;
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

    public function getChambre(): ?chambre
    {
        return $this->chambre;
    }

    public function setChambre(?chambre $chambre): self
    {
        $this->chambre = $chambre;

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

    public function getCategoriechambre(): ?categoriechambre
    {
        return $this->categoriechambre;
    }

    public function setCategoriechambre(?categoriechambre $categoriechambre): self
    {
        $this->categoriechambre = $categoriechambre;

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



}
