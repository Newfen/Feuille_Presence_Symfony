<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[InheritanceType('JOINED')]
#[DiscriminatorColumn(name: 'discr', type: 'string')]
#[DiscriminatorMap(['user' => User::class, 'Formateurs' => Formateurs::class, 'Stagiaires' => Stagiaires::class])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: DailySignature::class)]
    private Collection $dailySignatures;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: UserPromo::class, orphanRemoval: true)]
    private Collection $userPromos;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: UserNomine::class)]
    private Collection $userNomines;


    public function __construct()
    {
        $this->dailySignatures = new ArrayCollection();
        $this->userPromos = new ArrayCollection();
        $this->userNomines = new ArrayCollection();
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

    /**
     * @return Collection<int, DailySignature>
     */
    public function getDailySignatures(): Collection
    {
        return $this->dailySignatures;
    }

    public function addDailySignature(DailySignature $dailySignature): self
    {
        if (!$this->dailySignatures->contains($dailySignature)) {
            $this->dailySignatures->add($dailySignature);
            $dailySignature->setUtilisateur($this);
        }

        return $this;
    }

    public function removeDailySignature(DailySignature $dailySignature): self
    {
        if ($this->dailySignatures->removeElement($dailySignature)) {
            // set the owning side to null (unless already changed)
            if ($dailySignature->getUtilisateur() === $this) {
                $dailySignature->setUtilisateur(null);
            }
        }

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
            $userPromo->setUtilisateur($this);
        }

        return $this;
    }

    public function removeUserPromo(UserPromo $userPromo): self
    {
        if ($this->userPromos->removeElement($userPromo)) {
            // set the owning side to null (unless already changed)
            if ($userPromo->getUtilisateur() === $this) {
                $userPromo->setUtilisateur(null);
            }
        }

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
            $userNomine->setUtilisateur($this);
        }

        return $this;
    }

    public function removeUserNomine(UserNomine $userNomine): self
    {
        if ($this->userNomines->removeElement($userNomine)) {
            // set the owning side to null (unless already changed)
            if ($userNomine->getUtilisateur() === $this) {
                $userNomine->setUtilisateur(null);
            }
        }

        return $this;
    }
}
