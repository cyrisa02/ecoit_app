<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
#[ApiResource()]
class Questions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 190)]
    private string $title;

    #[ORM\Column(type: 'string', length: 190)]
    private string $question;

    #[ORM\Column(type: 'text')]
    private string $correction;

    // #[ORM\Column(type: 'boolean')]
    // private bool $is_answer_ok;

    // #[ORM\Column(type: 'boolean')]
    // private bool $is_corrected;

    #[ORM\ManyToMany(targetEntity: Quizes::class, mappedBy: 'questions')]
    private $quizes;

    #[ORM\Column(type: 'string', length: 190)]
    private $propsition1;

    #[ORM\Column(type: 'string', length: 190)]
    private $proposition2;

    #[ORM\Column(type: 'string', length: 190)]
    private $proposition3;

    #[ORM\Column(type: 'string', length: 190)]
    private $goodanswer;

    public function __construct()
    {
        $this->quizes = new ArrayCollection();
    }

     public function __toString()
    {
        return $this->title;
        return $this->question;
        return $this->correction;
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

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getCorrection(): ?string
    {
        return $this->correction;
    }

    public function setCorrection(string $correction): self
    {
        $this->correction = $correction;

        return $this;
    }

    // public function isIsAnswerOk(): ?bool
    // {
    //     return $this->is_answer_ok;
    // }

    // public function setIsAnswerOk(bool $is_answer_ok): self
    // {
    //     $this->is_answer_ok = $is_answer_ok;

    //     return $this;
    // }

    // public function isIsCorrected(): ?bool
    // {
    //     return $this->is_corrected;
    // }

    // public function setIsCorrected(bool $is_corrected): self
    // {
    //     $this->is_corrected = $is_corrected;

    //     return $this;
    // }

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
            $quize->addQuestion($this);
        }

        return $this;
    }

    public function removeQuize(Quizes $quize): self
    {
        if ($this->quizes->removeElement($quize)) {
            $quize->removeQuestion($this);
        }

        return $this;
    }

    public function getPropsition1(): ?string
    {
        return $this->propsition1;
    }

    public function setPropsition1(string $propsition1): self
    {
        $this->propsition1 = $propsition1;

        return $this;
    }

    public function getProposition2(): ?string
    {
        return $this->proposition2;
    }

    public function setProposition2(string $proposition2): self
    {
        $this->proposition2 = $proposition2;

        return $this;
    }

    public function getProposition3(): ?string
    {
        return $this->proposition3;
    }

    public function setProposition3(string $proposition3): self
    {
        $this->proposition3 = $proposition3;

        return $this;
    }

    public function getGoodanswer(): ?string
    {
        return $this->goodanswer;
    }

    public function setGoodanswer(string $goodanswer): self
    {
        $this->goodanswer = $goodanswer;

        return $this;
    }

   
}