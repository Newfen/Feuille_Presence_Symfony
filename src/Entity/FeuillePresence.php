<?php

namespace App\Entity;

use App\Repository\FeuillePresenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeuillePresenceRepository::class)]
class FeuillePresence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $semaine = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\OneToMany(mappedBy: 'feuille', targetEntity: UserNomine::class)]
    private Collection $userNomines;

    public function __construct()
    {
        $this->userNomines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSemaine(): ?string
    {
        return $this->semaine;
    }

    public function setSemaine(?string $semaine): self
    {
        $this->semaine = $semaine;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, UserNomine>
     */
    public function getUserNomines(): Collection
    {
        return $this->userNomines;
    }

    public function addUserNomine(UserNomine $userNomine): self
    {
        if (!$this->userNomines->contains($userNomine)) {
            $this->userNomines->add($userNomine);
            $userNomine->setFeuille($this);
        }

        return $this;
    }

    public function removeUserNomine(UserNomine $userNomine): self
    {
        if ($this->userNomines->removeElement($userNomine)) {
            // set the owning side to null (unless already changed)
            if ($userNomine->getFeuille() === $this) {
                $userNomine->setFeuille(null);
            }
        }

        return $this;
    }
}
