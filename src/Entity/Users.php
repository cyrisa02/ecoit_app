<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */

 #[Vich\Uploadable]
            #[ORM\Entity(repositoryClass: UsersRepository::class)]
            class Users implements UserInterface, PasswordAuthenticatedUserInterface
            {
                #[ORM\Id]
                #[ORM\GeneratedValue]
                #[ORM\Column(type: 'integer')]
                private ?int $id;
            
                #[ORM\Column(type: 'string', length: 180, unique: true)]
                private string $email;
            
                #[ORM\Column(type: 'json')]
                private array $roles = [];
            
                #[ORM\Column(type: 'string')]
                private string $password;
            
                #[ORM\Column(type: 'string', length: 190)]
                private string $lastname;
            
                #[ORM\Column(type: 'string', length: 190)]
                private string $firstname;
            
                 #[ORM\Column(type: 'string', length: 190)]     
                 private ?string $decription;
            
                // #[ORM\Column(type: 'string', length: 190)]
                // private ?string $picture;
            
                #[ORM\Column(type: 'string', length: 190)]
                private ?string $pseudo;
            
                 #[Vich\UploadableField(mapping: 'formation_images', fileNameProperty: 'imageName')]
                private ?File $imageFile = null;
            
                 
                #[ORM\Column(type: 'string', nullable: true)]
                private ?string $imageName = null;
            
            
                #[ORM\Column(type: 'datetime_immutable', options: ['default' =>'CURRENT_TIMESTAMP'])]
                private \DateTimeImmutable $created_at;
            
                #[ORM\Column(type: 'datetime_immutable', nullable: true)]
                private \DateTimeImmutable $updated_at;
            
                #[ORM\Column(type: 'boolean', nullable: true)]
                private bool $is_verified ; //, problème avec admin
            
                //#[ORM\Column(type: 'boolean', options: ['default' =>'0'])]
               // private bool $is_verified = false; //, problème avec admin
            
                #[ORM\Column(type: 'boolean')]
                private $is_validInstructor;
            
                #[ORM\Column(type: 'string', length: 190)]
                private string $reset_token;
            
                // #[ORM\Column(type: 'string', length: 190)]
                // private $plainPassword;
            
                // #[Assert\NotNull()]
                // #[ORM\OneToMany(mappedBy: 'users', targetEntity: Formations::class, cascade: ['persist', 'remove'])]
                // private $formations;
            
                //#[Assert\NotNull()]
                // #[ORM\OneToOne(mappedBy: 'users', targetEntity: Directories::class, cascade: ['persist', 'remove'])]
                // #[ORM\OneToOne(mappedBy: 'users', targetEntity: Directories::class)]
                // private $directories;
            
                #[ORM\OneToMany(mappedBy: 'users', targetEntity: EndedLessons::class)]
                private $endedLessons;
         
                #[ORM\ManyToMany(targetEntity: Formations::class, inversedBy: 'users')]
                private $formations;
            
                
            
                public function __construct()
                {
                    $this->created_at = new \DateTimeImmutable();
                    $this->updated_at = new \DateTimeImmutable();
                   // $this->formations = new ArrayCollection();
                    $this->endedLessons = new ArrayCollection();
                   
                }
            
            public function __toString()
                {
                    return $this->email;
                   
                    return $this->lastname;
                    return $this->firstname;
            
                    return $this->decription;
                    
                    return $this->pseudo;
                }
            
                
            
            
                public function getId(): ?int
                {
                    return $this->id;
                }
            
                public function getEmail(): ?string
                {
                    return $this->email;
                }
            
                public function setEmail(string $email): self
                {
                    $this->email = $email;
            
                    return $this;
                }
            
                /**
                 * A visual identifier that represents this user.
                 *
                 * @see UserInterface
                 */
                public function getUserIdentifier(): string
                {
                    return (string) $this->email;
                }
            
                /**
                 * @see UserInterface
                 */
                public function getRoles(): array
                {
                    $roles = $this->roles;
                    // guarantee every user at least has ROLE_USER
                    $roles[] = 'ROLE_USER';
            
                    return array_unique($roles);
                }
            
                public function setRoles(array $roles): self
                {
                    $this->roles = $roles;
            
                    return $this;
                }
            
                /**
                 * @see PasswordAuthenticatedUserInterface
                 */
                public function getPassword(): string
                {
                    return $this->password;
                }
            
                public function setPassword(string $password): self
                {
                    $this->password = $password;
            
                    return $this;
                }
            
                /**
                 * @see UserInterface
                 */
                public function eraseCredentials()
                {
                    // If you store any temporary, sensitive data on the user, clear it here
                    // $this->plainPassword = null;
                }
            
                public function getLastname(): ?string
                {
                    return $this->lastname;
                }
            
                public function setLastname(string $lastname): self
                {
                    $this->lastname = $lastname;
            
                    return $this;
                }
            
                public function getFirstname(): ?string
                {
                    return $this->firstname;
                }
            
                public function setFirstname(string $firstname): self
                {
                    $this->firstname = $firstname;
            
                    return $this;
                }
            
                 public function getDecription(): ?string
                 {
                     return $this->decription;
                 }
            
                 public function setDecription(string $decription): self
                 {
                     $this->decription = $decription;
            
                     return $this;
                 }
            
                // public function getPicture(): ?string
                // {
                //     return $this->picture;
                // }
            
                // public function setPicture(string $picture): self
                // {
                //     $this->picture = $picture;
            
                //     return $this;
                // }
            
                public function getPseudo(): ?string
                {
                    return $this->pseudo;
                }
            
                public function setPseudo(string $pseudo): self
                {
                    $this->pseudo = $pseudo;
            
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
            
                public function isIsVerified(): ?bool
                {
                    return $this->is_verified;
                }
            
                public function setIsVerified(bool $is_verified): self
                {
                    $this->is_verified = $is_verified;
            
                    return $this;
                }
            
                public function isIsValidInstructor(): ?bool
                {
                    return $this->is_validInstructor;
                }
            
                public function setIsValidInstructor(bool $is_validInstructor): self
                {
                    $this->is_validInstructor = $is_validInstructor;
            
                    return $this;
                }
            
                public function getResetToken(): ?string
                {
                    return $this->reset_token;
                }
            
                public function setResetToken(string $reset_token): self
                {
                    $this->reset_token = $reset_token;
            
                    return $this;
                }
            
                // public function getPlainPassword(): ?string
                // {
                //     return $this->plainPassword;
                // }
            
                // public function setPlainPassword(string $plainPassword): self
                // {
                //     $this->plainPassword = $plainPassword;
            
                //     return $this;
                // }
            
                // /**
                //  * @return Collection<int, Formations>
                //  */
                // public function getFormations(): Collection
                // {
                //     return $this->formations;
                // }
            
                // public function addFormation(Formations $formation): self
                // {
                //     if (!$this->formations->contains($formation)) {
                //         $this->formations[] = $formation;
                //         $formation->setUsers($this);
                //     }
            
                //     return $this;
                // }
            
                // public function removeFormation(Formations $formation): self
                // {
                //     if ($this->formations->removeElement($formation)) {
                //         // set the owning side to null (unless already changed)
                //         if ($formation->getUsers() === $this) {
                //             $formation->setUsers(null);
                //         }
                //     }
            
                //     return $this;
                // }
            
                // public function getDirectories(): ?Directories
                // {
                //     return $this->directories;
                // }
            
                // public function setDirectories(Directories $directories): self
                // {
                //     // set the owning side of the relation if necessary
                //     if ($directories->getUsers() !== $this) {
                //         $directories->setUsers($this);
                //     }
            
                //     $this->directories = $directories;
            
                //     return $this;
                // }
            
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
                        $endedLesson->setUsers($this);
                    }
            
                    return $this;
                }
            
                public function removeEndedLesson(EndedLessons $endedLesson): self
                {
                    if ($this->endedLessons->removeElement($endedLesson)) {
                        // set the owning side to null (unless already changed)
                        if ($endedLesson->getUsers() === $this) {
                            $endedLesson->setUsers(null);
                        }
                    }
            
                    return $this;
                }
      
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
                    }
   
                    return $this;
                }

                public function removeFormation(Formations $formation): self
                {
                    $this->formations->removeElement($formation);

                    return $this;
                }
            
                
            }