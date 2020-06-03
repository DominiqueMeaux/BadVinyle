<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 * @ORM\Table(name="categories")
 */
class Categories {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="cat_id")
     */
    private $cat_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $cat_libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $cat_upper_cat;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="category")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getCatId(): ?int {
        return $this->cat_id;
    }

    public function setCatId(int $cat_id): self {
        $this->cat_id = $cat_id;

        return $this;
    }

    public function getCatLibelle(): ?string {
        return $this->cat_libelle;
    }

    public function setCatLibelle(string $cat_libelle): self {
        $this->cat_libelle = $cat_libelle;

        return $this;
    }

    public function getCatUpperCat(): ?int {
        return $this->cat_upper_cat;
    }

    public function setCatUpperCat(int $cat_upper_cat): self {
        $this->cat_upper_cat = $cat_upper_cat;

        return this;
    }

    /**
     * @return Collection|Products[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

}
