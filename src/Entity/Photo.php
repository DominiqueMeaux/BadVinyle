<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 * @ORM\Table(name="photo")
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="photo_id")
     */
    private $photo_id;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $photo_format;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $photo_descr;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="photo")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getPhotoId(): ?int
    {
        return $this->photo_id;
    }

    public function getPhotoFormat(): ?string
    {
        return $this->photo_format;
    }

    public function setPhotoFormat(string $photo_format): self
    {
        $this->photo_format = $photo_format;

        return $this;
    }

    public function getPhotoDescr(): ?string
    {
        return $this->photo_descr;
    }

    public function setPhotoDescr(?string $photo_descr): self
    {
        $this->photo_descr = $photo_descr;

        return $this;
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
            $product->setPhoto($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getPhoto() === $this) {
                $product->setPhoto(null);
            }
        }

        return $this;
    }
}
