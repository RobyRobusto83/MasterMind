<?php

namespace App\Entity;

use App\Repository\MatchDocumentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchDocumentRepository::class)]
class MatchDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'guid')]
    private $uuid;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'string', length: 255)]
    private $targetColors;

    #[ORM\Column(type: 'string', length: 255)]
    private $status;

    #[ORM\Column(type: 'boolean')]
    private $successful;


     public function __construct()
        {
            $this->createdAt = new \DateTime();
            $this->successful = false;
        }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    /**
     * @return mixed
     */
    public function getTargetColors()
    {
        return $this->targetColors;
    }

    /**
     * @param mixed $targetColors
     */
    public function setTargetColors($targetColors): void
    {
        $this->targetColors = $targetColors;
    }


    public function getstatus(): ?string
    {
        return $this->status;
    }

    public function setstatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuccessful(): bool
    {
        return $this->successful;
    }

    /**
     * @param mixed $successful
     */
    public function setSuccessful(bool $successful): void
    {
        $this->successful = $successful;
    }



}