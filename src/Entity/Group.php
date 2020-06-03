<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="group_id")
     */
    private $group_id;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $group_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $group_descr;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="groupe")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getGroupId(): ?int
    {
        return $this->group_id;
    }

    

    public function getGroupName(): ?string
    {
        return $this->group_name;
    }

    public function setGroupName(string $group_name): self
    {
        $this->group_name = $group_name;

        return $this;
    }

    public function getGroupDescr(): ?string
    {
        return $this->group_descr;
    }

    public function setGroupDescr(string $group_descr): self
    {
        $this->group_descr = $group_descr;

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
            $product->setGroupe($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getGroupe() === $this) {
                $product->setGroupe(null);
            }
        }

        return $this;
    }
}
