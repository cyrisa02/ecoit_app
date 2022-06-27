<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuizesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: QuizesRepository::class)]
#[ApiResource()]
class Quizes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 190)]
    private string $title;

    // #[ORM\OneToOne(inversedBy: 'quizes', targetEntity: Sections::class, cascade: ['persist', 'remove'])]
    // #[ORM\JoinColumn(nullable: false)]
    // private $sections;

    #[ORM\ManyToMany(targetEntity: Questions::class, inversedBy: 'quizes')]
    private $questions;

    #[ORM\ManyToMany(targetEntity: Sections::class, mappedBy: 'quizes')]
    private $sections;


    
     public function __construct()
    {
         $this->questions = new ArrayCollection();
         $this->sections = new ArrayCollection();
    }

    

    
    public function __toString()
    {
        return $this->title;
        return $this->questions;
        return $this->quizes;
        
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

    // public function getSections(): ?Sections
    // {
    //     return $this->sections;
    // }

    // public function setSections(Sections $sections): self
    // {
    //     $this->sections = $sections;

    //     return $this;
    // }

     /**
      * @return Collection<int, Questions>
      */
     public function getQuestions(): Collection
     {
         return $this->questions;
     }

     public function addQuestion(Questions $question): self
     {
         if (!$this->questions->contains($question)) {
             $this->questions[] = $question;
         }

         return $this;
     }

     public function removeQuestion(Questions $question): self
     {
         $this->questions->removeElement($question);

         return $this;
     }

     /**
      * @return Collection<int, Sections>
      */
     public function getSections(): Collection
     {
         return $this->sections;
     }

     public function addSection(Sections $section): self
     {
         if (!$this->sections->contains($section)) {
             $this->sections[] = $section;
             $section->addQuize($this);
         }

         return $this;
     }

     public function removeSection(Sections $section): self
     {
         if ($this->sections->removeElement($section)) {
             $section->removeQuize($this);
         }

         return $this;
     }

    
}