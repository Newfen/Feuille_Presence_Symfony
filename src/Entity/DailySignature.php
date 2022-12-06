<?php

namespace App\Entity;

use App\Repository\DailySignatureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DailySignatureRepository::class)]
class DailySignature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'dailySignatures')]
    private ?User $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'dailySignatures')]
    private ?User $feuille = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fait_le = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $etatSignature = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getFeuille(): ?User
    {
        return $this->feuille;
    }

    public function setFeuille(?User $feuille): self
    {
        $this->feuille = $feuille;

        return $this;
    }

    public function getFaitLe(): ?\DateTimeInterface
    {
        return $this->fait_le;
    }

    public function setFaitLe(\DateTimeInterface $fait_le): self
    {
        $this->fait_le = $fait_le;

        return $this;
    }

    public function getEtatSignature(): ?string
    {
        return $this->etatSignature;
    }

    public function setEtatSignature(?string $etatSignature): self
    {
        $this->etatSignature = $etatSignature;

        return $this;
    }
}
