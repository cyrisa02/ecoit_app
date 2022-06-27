<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SectionsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SectionsRepository::class)]
#[ApiResource()]
class Sections
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 190)]
    private string $title;

    // #[ORM\ManyToOne(targetEntity: Formations::class, inversedBy: 'sections')]
    // #[ORM\JoinColumn(nullable: false)]
    // private $formations;

    // #[ORM\OneToOne(mappedBy: 'sections', targetEntity: Quizes::class, cascade: ['persist', 'remove'])]
    // private $quizes;

    // #[ORM\OneToOne(mappedBy: 'sections',targetEntity: Lessons::class, cascade: ['persist', 'remove'])]
    // //#[Assert\NotNull()]
    // private $lessons;

    #[ORM\ManyToMany(targetEntity: Formations::class, mappedBy: 'sections')]
    private $formations;

    #[ORM\ManyToMany(targetEntity: Lessons::class, mappedBy: 'sections')]
    private $lessons;

    #[ORM\ManyToMany(targetEntity: Quizes::class, inversedBy: 'sections')]
    private $quizes;

    public function __construct()
    {
        $this->formations = new ArrayCollection();
        $this->lessons = new ArrayCollection();
        $this->quizes = new ArrayCollection();
    }

   

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

    // public function getFormations(): ?Formations
    // {
    //     return $this->formations;
    // }

    // public function setFormations(?Formations $formations): self
    // {
    //     $this->formations = $formations;

    //     return $this;
    // }

    // public function getQuizes(): ?Quizes
    // {
    //     return $this->quizes;
    // }

    // public function setQuizes(Quizes $quizes): self
    // {
    //     // set the owning side of the relation if necessary
    //     if ($quizes->getSections() !== $this) {
    //         $quizes->setSections($this);
    //     }

    //     $this->quizes = $quizes;

    //     return $this;
    // }

    

    // public function getLessons(): ?Lessons
    // {
    //     return $this->lessons;
    // }

    // public function setLessons(?Lessons $lessons): self
    // {
    //     // unset the owning side of the relation if necessary
    //     if ($lessons === null && $this->lessons !== null) {
    //         $this->lessons->setSections(null);
    //     }

    //     // set the owning side of the relation if necessary
    //     if ($lessons !== null && $lessons->getSections() !== $this) {
    //         $lessons->setSections($this);
    //     } 

    //     $this->lessons = $lessons;

    //     return $this;  
    // }

    /**
     * @return Collection<int, Formations>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formations $formation): self
    {
        if (!$this->formations->contains($formation)) {
            $this->formations[] = $formation;
            $formation->addSection($this);
        }

        return $this;
    }

    public function removeFormation(Formations $formation): self
    {
        if ($this->formations->removeElement($formation)) {
            $formation->removeSection($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Lessons>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lessons $lesson): self
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons[] = $lesson;
            $lesson->addSection($this);
        }

        return $this;
    }

    public function removeLesson(Lessons $lesson): self
    {
        if ($this->lessons->removeElement($lesson)) {
            $lesson->removeSection($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Quizes>
     */
    public function getQuizes(): Collection
    {
        return $this->quizes;
    }

    public function addQuize(Quizes $quize): self
    {
        if (!$this->quizes->contains($quize)) {
            $this->quizes[] = $quize;
        }

        return $this;
    }

    public function removeQuize(Quizes $quize): self
    {
        $this->quizes->removeElement($quize);

        return $this;
    }
}