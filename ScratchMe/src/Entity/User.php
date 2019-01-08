<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $image_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Localisation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $localisation_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="user", orphanRemoval=true)
     */
    private $product_id;

    public function __construct()
    {
        $this->product_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getImageId(): ?Image
    {
        return $this->image_id;
    }

    public function setImageId(Image $image_id): self
    {
        $this->image_id = $image_id;

        return $this;
    }

    public function getLocalisationId(): ?Localisation
    {
        return $this->localisation_id;
    }

    public function setLocalisationId(Localisation $localisation_id): self
    {
        $this->localisation_id = $localisation_id;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProduct�Id(): Collection
    {
        return $this->product�_id;
    }

    public function addProductId(Product $productId): self
    {
        if (!$this->product�_id->contains($productId)) {
            $this->product�_id[] = $productId;
            $productId->setUser($this);
        }

        return $this;
    }

    public function removeProductId(Product $productId): self
    {
        if ($this->product�_id->contains($productId)) {
            $this->product�_id->removeElement($productId);
            // set the owning side to null (unless already changed)
            if ($productId->getUser() === $this) {
                $productId->setUser(null);
            }
        }

        return $this;
    }
}
