<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(operations: [
    new Get(uriTemplate: '/users/{id}', 
    requirements: ['id' => '\d+'], 
    defaults: ['color' => 'brown'], 
    schemes: ['https'], 
    host: '{subdomain}.api-platform.com'),
    new GetCollection(),
    new Post(),
])]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    /**
     *
     * @Groups({"user:read", "groupe:read"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="text")
     *
     * @Groups({"user:read", "user:write", "groupe:read"})
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    /**
     * @ORM\Column(type="text")
     *
     * @Groups({"user:read", "user:write", "groupe:read"})
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;
    /** 
     * @ORM\Column(type="text")
     *
     * @Groups({"user:read", "user:write", "groupe:read"})
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"user:read", "groupe:read"})
     */
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"user:read", "groupe:read"})
     */
    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Groupe", inversedBy="user_groupe")
     * @ORM\JoinColumn(nullable=true)
     * 
     * 
     */
    #[ORM\ManyToOne(inversedBy: 'user_groupe')]
    private ?Groupe $groupe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

   
    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }
}
