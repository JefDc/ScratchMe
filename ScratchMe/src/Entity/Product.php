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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="productÂ_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="product")
     */
    private $category_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Localisation", mappedBy="product")
     */
    private $localisation_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image")
     */
    private $image_id;

    public function __construct()
    {
        $this->category_id = new ArrayCollection();
        $this->localisation_id = new ArrayCollection();
        $this->image_id = new ArrayCollection();
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
    public function getImageId(): Collection
    {
        return $this->image_id;
    }

    public function addImageId(Image $imageId): self
    {
        if (!$this->image_id->contains($imageId)) {
            $this->image_id[] = $imageId;
        }

        return $this;
    }

    public function removeImageId(Image $imageId): self
    {
        if ($this->image_id->contains($imageId)) {
            $this->image_id->removeElement($imageId);
        }

        return $this;
    }
}
