<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FormationsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\File as EntityFile;
// use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]

#[ORM\HasLifecycleCallbacks]
#[ApiResource( 
    collectionOperations: ['get'],
    itemOperations: ['get'],    
    normalizationContext: ['groups' => ['read'], "enable_max_depth"=>true],
)]

class Formations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read'])]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 190)]
    #[Groups(['read'])]
    private string $title;

    #[ORM\Column(type: 'text')]
    #[Groups(['read'])]
    private string $description;

    #[ORM\Column(type: 'string', length: 190)]
    private string $slug;

    #[ORM\Column(type: 'boolean')]
    private $is_endedFormation;

    #[ORM\Column(type: 'boolean')]
    private $is_Favorite;

    
    #[ORM\Column(type: 'datetime_immutable', options: ['default' =>'CURRENT_TIMESTAMP'])]
    private \DateTimeImmutable $created_at;

    

    // #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'formations')]
    // private $users;

    
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

   #[ORM\Column(type: 'string', length: 190)]
   #[Groups(['read:collection'])]
   private $image;

   

   

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        
        $this->sections = new ArrayCollection();
        
        $this->users = new ArrayCollection();
        
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

public function getImage(): ?string
{
    return $this->image;
}

public function setImage(string $image): self
{
    $this->image = $image;

    return $this;
}



    

    
}