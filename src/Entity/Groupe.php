<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
#[ApiResource]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'groupe', targetEntity: User::class)]
    private Collection $user_groupe;

    public function __construct()
    {
        $this->user_groupe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserGroupe(): Collection
    {
        return $this->user_groupe;
    }

    public function addUserGroupe(User $userGroupe): self
    {
        if (!$this->user_groupe->contains($userGroupe)) {
            $this->user_groupe->add($userGroupe);
            $userGroupe->setGroupe($this);
        }

        return $this;
    }

    public function removeUserGroupe(User $userGroupe): self
    {
        if ($this->user_groupe->removeElement($userGroupe)) {
            // set the owning side to null (unless already changed)
            if ($userGroupe->getGroupe() === $this) {
                $userGroupe->setGroupe(null);
            }
        }

        return $this;
    }
}
