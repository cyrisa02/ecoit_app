<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 190)]
    private string $name;

    #[ORM\OneToOne(inversedBy: 'images', targetEntity: Formations::class, cascade: ['persist', 'remove'])]
    private $formations;

    public function __toString()
    {
        return $this->name;
        
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFormations(): ?Formations
    {
        return $this->formations;
    }

    public function setFormations(?Formations $formations): self
    {
        $this->formations = $formations;

        return $this;
    }
}