<?php

namespace App\Entity;

use App\Repository\LabelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LabelRepository::class)
 * @ORM\Table(name="`label`")
 */
class Label
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=9, name="label_siren")
     */
    private $label_siren;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lab_libele;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $lab_mail;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $lab_descr;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="labels")
     * @ORM\JoinColumn(nullable=false, name="address_id", referencedColumnName="address_id")
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="label")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->lab_siren;
    }

    public function getLabLibele(): ?string
    {
        return $this->lab_libele;
    }

    public function setLabLibele(string $lab_libele): self
    {
        $this->lab_libele = $lab_libele;

        return $this;
    }

    public function getLabMail(): ?string
    {
        return $this->lab_mail;
    }

    public function setLabMail(string $lab_mail): self
    {
        $this->lab_mail = $lab_mail;

        return $this;
    }

    public function getLabDescr(): ?string
    {
        return $this->lab_descr;
    }

    public function setLabDescr(?string $lab_descr): self
    {
        $this->lab_descr = $lab_descr;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

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
            $product->setLabel($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getLabel() === $this) {
                $product->setLabel(null);
            }
        }

        return $this;
    }
}
