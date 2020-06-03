<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProviderRepository::class)
 */
class Provider {

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=9)
     */
    private $prov_siren;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $prov_name;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $prov_mail;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $prov_phone;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $prov_descr;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProvider::class, inversedBy="providers")
     * @ORM\JoinColumn(name="type_provider_id", referencedColumnName="type_prov_id")
     */
    private $type_provider;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="provider")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="providers")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="address_id")
     */
    private $address;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getProvSiren(): ?string {
        return $this->prov_siren;
    }

    public function setProvSiren(string $prov_siren): self {
        $this->prov_siren = $prov_siren;

        return $this;
    }

    public function getProvName(): ?string {
        return $this->prov_name;
    }

    public function setProvName(string $prov_name): self {
        $this->prov_name = $prov_name;

        return $this;
    }

    public function getProvMail(): ?string {
        return $this->prov_mail;
    }

    public function setProvMail(string $prov_mail): self {
        $this->prov_mail = $prov_mail;

        return $this;
    }

    public function getProvPhone(): ?string {
        return $this->prov_phone;
    }

    public function setProvPhone(string $prov_phone): self {
        $this->prov_phone = $prov_phone;

        return $this;
    }

    public function getProvDescr(): ?string {
        return $this->prov_descr;
    }

    public function setProvDescr(string $prov_descr): self {
        $this->prov_descr = $prov_descr;

        return $this;
    }

    public function getTypeProvider(): ?TypeProvider
    {
        return $this->type_provider;
    }

    public function setTypeProvider(?TypeProvider $type_provider): self
    {
        $this->type_provider = $type_provider;

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
            $product->setProvider($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getProvider() === $this) {
                $product->setProvider(null);
            }
        }

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

}
