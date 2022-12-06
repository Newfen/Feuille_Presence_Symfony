<?php

namespace App\Entity;

use App\Repository\PromotionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionsRepository::class)]
class Promotions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $intitule = null;

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: UserPromo::class)]
    private Collection $userPromos;

    public function __construct()
    {
        $this->userPromos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * @return Collection<int, UserPromo>
     */
    public function getUserPromos(): Collection
    {
        return $this->userPromos;
    }

    public function addUserPromo(UserPromo $userPromo): self
    {
        if (!$this->userPromos->contains($userPromo)) {
            $this->userPromos->add($userPromo);
            $userPromo->setPromotion($this);
        }

        return $this;
    }

    public function removeUserPromo(UserPromo $userPromo): self
    {
        if ($this->userPromos->removeElement($userPromo)) {
            // set the owning side to null (unless already changed)
            if ($userPromo->getPromotion() === $this) {
                $userPromo->setPromotion(null);
            }
        }

        return $this;
    }
}
