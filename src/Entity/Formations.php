<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
class Formations
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

    #[ORM\Column(type: 'boolean')]
    private $is_endedFormation;

    #[ORM\Column(type: 'boolean')]
    private $is_Favorite;

    
    #[ORM\Column(type: 'datetime_immutable', options: ['default' =>'CURRENT_TIMESTAMP'])]
    private \DateTimeImmutable $created_at;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private \DateTimeImmutable $updated_at;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'formations')]
    private $users;

    #[ORM\OneToOne(mappedBy: 'formations', targetEntity: Images::class, cascade: ['persist', 'remove'])]
    private $images;

    #[ORM\ManyToOne(targetEntity: Directories::class, inversedBy: 'formations')]
    #[ORM\JoinColumn(nullable: false)]
    private $directories;

   #[ORM\OneToMany(mappedBy: 'formations', targetEntity: Sections::class)]
private $sections;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
        $this->sections = new ArrayCollection();       
        
    }

    public function __toString()
    {
        return $this->title;
        return $this->description;
        return $this->slug;
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

    public function isIsEndedFormation(): ?bool
    {
        return $this->is_endedFormation;
    }

    public function setIsEndedFormation(bool $is_endedFormation): self
    {
        $this->is_endedFormation = $is_endedFormation;

        return $this;
    }

    public function isIsFavorite(): ?bool
    {
        return $this->is_Favorite;
    }

    public function setIsFavorite(bool $is_Favorite): self
    {
        $this->is_Favorite = $is_Favorite;

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

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getImages(): ?Images
    {
        return $this->images;
    }

    public function setImages(?Images $images): self
    {
        // unset the owning side of the relation if necessary
        if ($images === null && $this->images !== null) {
            $this->images->setFormations(null);
        }

        // set the owning side of the relation if necessary
        if ($images !== null && $images->getFormations() !== $this) {
            $images->setFormations($this);
        } 

        $this->images = $images;

        return $this;
    }

    public function getDirectories(): ?Directories
    {
        return $this->directories;
    }

    public function setDirectories(?Directories $directories): self
    {
        $this->directories = $directories;

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
$section->setFormations($this);
}

return $this;
}

public function removeSection(Sections $section): self
{
if ($this->sections->removeElement($section)) {
// set the owning side to null (unless already changed)
if ($section->getFormations() === $this) {
$section->setFormations(null);
}
}

return $this;
}

    

    
}