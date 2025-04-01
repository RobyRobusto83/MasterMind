<?php

namespace App\Entity;

use App\Repository\MovesDocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovesDocumentRepository::class)]
class MovesDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'guid')]
    private $matchId;

   #[ORM\Column(type: 'string')]
    private $codigoPropuesto;

    #[ORM\Column(type: 'string')]
    private $attemptedAnswers;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;


     public function __construct()
        {
            $this->createdAt = new \DateTime();
        }

     public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getMatchId()
    {
        return $this->matchId;
    }

    /**
     * @param mixed $matchId
     */
    public function setMatchId($matchId): void
    {
        $this->matchId = $matchId;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

     public function getCodigoPropuesto(): ?string
    {
        return $this->codigoPropuesto;
    }

    public function setCodigoPropuesto(string $codigoPropuesto): self
    {
        $this->codigoPropuesto = $codigoPropuesto;
        return $this;
    }

    public function setAttemptedAnswers(string $attemptedAnswers): self
    {
        $this->attemptedAnswers = $attemptedAnswers;
        return $this;
    }

    public function getAttemptedAnswers(): ?string
    {
        return $this->attemptedAnswers;
    }

}