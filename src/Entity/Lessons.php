<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LessonsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;




#[ORM\Entity(repositoryClass: LessonsRepository::class)]
#[ApiResource()]
class Lessons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 190)]
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'string', length: 190)]
    private string $slug;

    #[ORM\Column(type: 'string', length: 190)]
    private string $video;

    #[ORM\Column(type: 'boolean')]
    private bool $is_ended;

   
    #[ORM\Column(type: 'datetime_immutable', options: ['default' =>'CURRENT_TIMESTAMP'])]
    private \DateTimeImmutable $created_at;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private \DateTimeImmutable $updated_at;

    

    

    #[ORM\OneToMany(mappedBy: 'lessons', targetEntity: Ressources::class)]
    private $ressources;

    

    #[ORM\OneToMany(mappedBy: 'lessons', targetEntity: EndedLessons::class)]
    private $endedLessons;

    #[ORM\ManyToMany(targetEntity: Sections::class, inversedBy: 'lessons')]
    private $sections;

    // #[ORM\OneToOne(inversedBy:'lessons', targetEntity: Sections::class, cascade: ['persist', 'remove'])]
    // //#[Assert\NotNull()]
    // private $sections;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
        $this->ressources = new ArrayCollection();
       
        $this->endedLessons = new ArrayCollection();
        $this->sections = new ArrayCollection();
        
    }

    public function __toString()
{
return $this->title;
return $this->description;
return $this->slug;
return $this->video;
return $this->sections;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function isIsEnded(): ?bool
    {
        return $this->is_ended;
    }

    public function setIsEnded(bool $is_ended): self
    {
        $this->is_ended = $is_ended;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    
    

    /**
     * @return Collection<int, Ressources>
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressources $ressource): self
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources[] = $ressource;
            $ressource->setLessons($this);
        }

        return $this;
    }

    public function removeRessource(Ressources $ressource): self
    {
        if ($this->ressources->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getLessons() === $this) {
                $ressource->setLessons(null);
            }
        }

        return $this;
    }

   
    /**
     * @return Collection<int, EndedLessons>
     */
    public function getEndedLessons(): Collection
    {
        return $this->endedLessons;
    }

    public function addEndedLesson(EndedLessons $endedLesson): self
    {
        if (!$this->endedLessons->contains($endedLesson)) {
            $this->endedLessons[] = $endedLesson;
            $endedLesson->setLessons($this);
        }

        return $this;
    }

    public function removeEndedLesson(EndedLessons $endedLesson): self
    {
        if ($this->endedLessons->removeElement($endedLesson)) {
            // set the owning side to null (unless already changed)
            if ($endedLesson->getLessons() === $this) {
                $endedLesson->setLessons(null);
            }
        }

        return $this;
    }

    // public function getSections(): ?Sections
    // {
    //     return $this->sections;
    // }

    // public function setSections(?Sections $sections): self
    // {
    //     $this->sections = $sections;

    //     return $this;
    // }

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
        }

        return $this;
    }

    public function removeSection(Sections $section): self
    {
        $this->sections->removeElement($section);

        return $this;
    }
}