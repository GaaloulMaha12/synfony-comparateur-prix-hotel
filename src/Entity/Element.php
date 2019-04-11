<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ElementRepository")
 */
class Element
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
    private $contenu_element;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $type_element;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Page", inversedBy="Element")
     */
    private $page;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuElement(): ?string
    {
        return $this->contenu_element;
    }

    public function setContenuElement(string $contenu_element): self
    {
        $this->contenu_element = $contenu_element;

        return $this;
    }

    public function getTypeElement(): ?string
    {
        return $this->type_element;
    }

    public function setTypeElement(string $type_element): self
    {
        $this->type_element = $type_element;

        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): self
    {
        $this->page = $page;

        return $this;
    }
}
