<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    normalizationContext: ['groups'=> ['read:collection']]
)]
class Formations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:collection'])]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 190)]
    #[Groups(['read:collection'])]
    private string $title;

    #[Vich\UploadableField(mapping: 'formation_images', fileNameProperty: 'imageName')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;


    #[ORM\Column(type: 'text')]
    #[Groups(['read:collection'])]
    private string $description;

    #[ORM\Column(type: 'string', length: 190)]
    private string $slug;

    #[ORM\Column(type: 'boolean')]
    private $is_endedFormation;

    #[ORM\Column(type: 'boolean')]
    private $is_Favorite;

    
    #[ORM\Column(type: 'datetime_immutable', options: ['default' =>'CURRENT_TIMESTAMP'])]
    private \DateTimeImmutable $created_at;

    #[ORM\Column(type: 'datetime_immutable')]
     #[Assert\NotNull()]
    private \DateTimeImmutable $updated_at;

    // #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'formations')]
    // private $users;

    #[ORM\OneToOne(mappedBy: 'formations', targetEntity: Images::class, cascade: ['persist', 'remove'])]
    private $images;

    // #[ORM\ManyToOne(targetEntity: Directories::class, inversedBy: 'formations')]
    // #[ORM\JoinColumn(nullable: false)]
    // private $directories;

//    #[ORM\OneToMany(mappedBy: 'formations', targetEntity: Sections::class)]
// private $sections;

//    #[ORM\ManyToMany(targetEntity: Directories::class, inversedBy: 'formations')]
//    private $directory;

   #[ORM\ManyToMany(targetEntity: Sections::class, inversedBy: 'formations')]
   private $sections;

   #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'formations')]
   private $users;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->updated_at = new \DateTimeImmutable();
        $this->sections = new ArrayCollection();
        //$this->directory = new ArrayCollection();       
        $this->users = new ArrayCollection();
        
    }

 #[ORM\PrePersist()]
                                              public function setUpdatedAtValue()
                                              {
                                                  $this->updatedAt = new \DateTimeImmutable();
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

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
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

    // public function getUsers(): ?Users
    // {
    //     return $this->users;
    // }

    // public function setUsers(?Users $users): self
    // {
    //     $this->users = $users;

    //     return $this;
    // }

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

    // public function getDirectories(): ?Directories
    // {
    //     return $this->directories;
    // }

    // public function setDirectories(?Directories $directories): self
    // {
    //     $this->directories = $directories;

    //     return $this;
    // }

 //   /**
// * @return Collection<int, Sections>
// */
// public function getSections(): Collection
// {
// return $this->sections;
// }
// public function addSection(Sections $section): self
// {
// if (!$this->sections->contains($section)) {
// $this->sections[] = $section;
// $section->setFormations($this);
// }

// return $this;
// }

// public function removeSection(Sections $section): self
// {
// if ($this->sections->removeElement($section)) {
// // set the owning side to null (unless already changed)
// if ($section->getFormations() === $this) {
// $section->setFormations(null);
// }
// }

// return $this;
// }

// /**
//  * @return Collection<int, Directories>
//  */
// public function getDirectory(): Collection
// {
//     return $this->directory;
// }

// public function addDirectory(Directories $directory): self
// {
//     if (!$this->directory->contains($directory)) {
//         $this->directory[] = $directory;
//     }

//     return $this;
// }

// public function removeDirectory(Directories $directory): self
// {
//     $this->directory->removeElement($directory);

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

/**
 * @return Collection<int, Users>
 */
public function getUsers(): Collection
{
    return $this->users;
}

public function addUser(Users $user): self
{
    if (!$this->users->contains($user)) {
        $this->users[] = $user;
        $user->addFormation($this);
    }

    return $this;
}

public function removeUser(Users $user): self
{
    if ($this->users->removeElement($user)) {
        $user->removeFormation($this);
    }

    return $this;
}

    

    
}