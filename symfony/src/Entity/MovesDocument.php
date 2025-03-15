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

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'string', length: 255)]
    private $color;

    #[ORM\Column(type: 'string', length: 255)]
    private $score;

    #[ORM\Column(type: 'integer', length:50)]
    private $codigoPropuesto;

    #[ORM\Column(type: 'integer')]
    private $bienColocadas;

    #[ORM\Column(type: 'integer')]
    private $malColocadas;

    #[ORM\ManyToOne(targetEntity: MatchDocument::class, inversedBy:"moves")]
    #[ORM\JoinColumn(nullable:false, onDelete:"CASCADE")]
    private $match;

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

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getMatch(): ?MatchDocument
    {
        return $this->match;
    }

    public function setMatch(?MatchDocument $match): self
    {
        $this->match = $match;
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

    public function getBienColocadas(): ?int
    {
        return $this->bienColocadas;
    }

    public function setBienColocadas(int $bienColocadas): self
    {
        $this->bienColocadas = $bienColocadas;
        return $this;
    }

    public function getMalColocadas(): ?int
    {
        return $this->malColocadas;
    }

    public function setMalColocadas(int $malColocadas): self
    {
        $this->malColocadas = $malColocadas;
        return $this;
    }
}