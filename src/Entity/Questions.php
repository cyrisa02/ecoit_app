<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
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

    #[ORM\Column(type: 'boolean')]
    private bool $is_answer_ok;

    #[ORM\Column(type: 'boolean')]
    private bool $is_corrected;

    #[ORM\ManyToOne(targetEntity: Quizes::class, inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private $quizes;

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

    public function isIsAnswerOk(): ?bool
    {
        return $this->is_answer_ok;
    }

    public function setIsAnswerOk(bool $is_answer_ok): self
    {
        $this->is_answer_ok = $is_answer_ok;

        return $this;
    }

    public function isIsCorrected(): ?bool
    {
        return $this->is_corrected;
    }

    public function setIsCorrected(bool $is_corrected): self
    {
        $this->is_corrected = $is_corrected;

        return $this;
    }

    public function getQuizes(): ?Quizes
    {
        return $this->quizes;
    }

    public function setQuizes(?Quizes $quizes): self
    {
        $this->quizes = $quizes;

        return $this;
    }
}