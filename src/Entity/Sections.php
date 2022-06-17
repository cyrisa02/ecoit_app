<?php

namespace App\Entity;

use App\Repository\SectionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SectionsRepository::class)]
class Sections
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 190)]
    private string $title;

    #[ORM\ManyToOne(targetEntity: Formations::class, inversedBy: 'sections')]
    #[ORM\JoinColumn(nullable: false)]
    private $formations;

    #[ORM\OneToOne(mappedBy: 'sections', targetEntity: Quizes::class, cascade: ['persist', 'remove'])]
    private $quizes;

    #[ORM\OneToOne(mappedBy: 'sections',targetEntity: Lessons::class, cascade: ['persist', 'remove'])]
    //#[Assert\NotNull()]
    private $lessons;

   

public function __toString()
    {
        return $this->title;
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getQuizes(): ?Quizes
    {
        return $this->quizes;
    }

    public function setQuizes(Quizes $quizes): self
    {
        // set the owning side of the relation if necessary
        if ($quizes->getSections() !== $this) {
            $quizes->setSections($this);
        }

        $this->quizes = $quizes;

        return $this;
    }

    

    public function getLessons(): ?Lessons
    {
        return $this->lessons;
    }

    public function setLessons(?Lessons $lessons): self
    {
        // unset the owning side of the relation if necessary
        if ($lessons === null && $this->lessons !== null) {
            $this->lessons->setSections(null);
        }

        // set the owning side of the relation if necessary
        if ($lessons !== null && $lessons->getSections() !== $this) {
            $lessons->setSections($this);
        } 

        $this->lessons = $lessons;

        return $this;  
    }
}