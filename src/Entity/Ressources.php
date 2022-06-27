<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RessourcesRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: RessourcesRepository::class)]
#[ApiResource()]
class Ressources
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 190)]
    private string $name;

    #[ORM\Column(type: 'string', length: 30)]
    private string $format;

    #[ORM\ManyToOne(targetEntity: Lessons::class, inversedBy: 'ressources')]
    private $lessons;

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

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getLessons(): ?Lessons
    {
        return $this->lessons;
    }

    public function setLessons(?Lessons $lessons): self
    {
        $this->lessons = $lessons;

        return $this;
    }
}