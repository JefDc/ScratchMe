<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", length=255)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="product�_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     */
    private $category;

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localisation")
     */
    private $location;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image")
     */
    private $image_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image")
     */
    private $image;

    public function __construct()
    {
        $this->category_id = new ArrayCollection();
        $this->localisation_id = new ArrayCollection();
        $this->image_id = new ArrayCollection();
        $this->image = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategoryId(): Collection
    {
        return $this->category_id;
    }

    public function addCategoryId(Category $categoryId): self
    {
        if (!$this->category_id->contains($categoryId)) {
            $this->category_id[] = $categoryId;
            $categoryId->setProduct($this);
        }

        return $this;
    }

    public function removeCategoryId(Category $categoryId): self
    {
        if ($this->category_id->contains($categoryId)) {
            $this->category_id->removeElement($categoryId);
            // set the owning side to null (unless already changed)
            if ($categoryId->getProduct() === $this) {
                $categoryId->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Localisation[]
     */
    public function getLocalisationId(): Collection
    {
        return $this->localisation_id;
    }

    public function addLocalisationId(Localisation $localisationId): self
    {
        if (!$this->localisation_id->contains($localisationId)) {
            $this->localisation_id[] = $localisationId;
            $localisationId->setProduct($this);
        }

        return $this;
    }

    public function removeLocalisationId(Localisation $localisationId): self
    {
        if ($this->localisation_id->contains($localisationId)) {
            $this->localisation_id->removeElement($localisationId);
            // set the owning side to null (unless already changed)
            if ($localisationId->getProduct() === $this) {
                $localisationId->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Image $image): self
    {
        if (!$this->image->contains($image)) {
            $this->image[] = $image;
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->image->contains($image)) {
            $this->image->removeElement($image);
        }

        return $this;
    }

}
