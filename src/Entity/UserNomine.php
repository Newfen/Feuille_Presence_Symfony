<?php

namespace App\Entity;

use App\Repository\UserNomineRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserNomineRepository::class)]
class UserNomine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userNomines')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'userNomines')]
    private ?FeuillePresence $feuille = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateTirage = null;

    #[ORM\Column(nullable: true)]
    private ?bool $recuperation = null;

    #[ORM\Column(nullable: true)]
    private ?int $nombrePas = null;

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

    public function getFeuille(): ?FeuillePresence
    {
        return $this->feuille;
    }

    public function setFeuille(?FeuillePresence $feuille): self
    {
        $this->feuille = $feuille;

        return $this;
    }

    public function getDateTirage(): ?\DateTimeInterface
    {
        return $this->dateTirage;
    }

    public function setDateTirage(\DateTimeInterface $dateTirage): self
    {
        $this->dateTirage = $dateTirage;

        return $this;
    }

    public function isRecuperation(): ?bool
    {
        return $this->recuperation;
    }

    public function setRecuperation(?bool $recuperation): self
    {
        $this->recuperation = $recuperation;

        return $this;
    }

    public function getNombrePas(): ?int
    {
        return $this->nombrePas;
    }

    public function setNombrePas(?int $nombrePas): self
    {
        $this->nombrePas = $nombrePas;

        return $this;
    }
}
