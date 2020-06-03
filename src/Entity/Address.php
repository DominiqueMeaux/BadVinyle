<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 * @ORM\Table(name="Address")
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer",  name="address_id")
     */
    private $address_id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $address_city;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $address_country;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $address_postal_code;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $address_street;

    /**
     * @ORM\ManyToOne(targetEntity=TypeAddress::class, inversedBy="addresses")
     * @ORM\JoinColumn(name="type_address_id", referencedColumnName="type_address_id")
     */
    private $type_address;

    /**
     * @ORM\OneToMany(targetEntity=Label::class, mappedBy="address")
     */
    private $labels;

    /**
     * @ORM\OneToMany(targetEntity=Provider::class, mappedBy="address")
     */
    private $providers;

    public function __construct()
    {
        $this->labels = new ArrayCollection();
        $this->providers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->address_id;
    }

    public function getAddressCity(): ?string
    {
        return $this->address_city;
    }

    public function setAddressCity(string $address_city): self
    {
        $this->address_city = $address_city;

        return $this;
    }

    public function getAddressCountry(): ?string
    {
        return $this->address_country;
    }

    public function setAddressCountry(string $address_country): self
    {
        $this->address_country = $address_country;

        return $this;
    }

    public function getAddressPostalCode(): ?string
    {
        return $this->address_postal_code;
    }

    public function setAddressPostalCode(string $address_postal_code): self
    {
        $this->address_postal_code = $address_postal_code;

        return $this;
    }

    public function getAddressStreet(): ?string
    {
        return $this->address_street;
    }

    public function setAddressStreet(string $address_street): self
    {
        $this->address_street = $address_street;

        return $this;
    }

    public function getTypeAddress(): ?TypeAddress
    {
        return $this->type_address;
    }

    public function setTypeAddress(?TypeAddress $type_address): self
    {
        $this->type_address = $type_address;

        return $this;
    }

    /**
     * @return Collection|Label[]
     */
    public function getLabels(): Collection
    {
        return $this->labels;
    }

    public function addLabel(Label $label): self
    {
        if (!$this->labels->contains($label)) {
            $this->labels[] = $label;
            $label->setAddress($this);
        }

        return $this;
    }

    public function removeLabel(Label $label): self
    {
        if ($this->labels->contains($label)) {
            $this->labels->removeElement($label);
            // set the owning side to null (unless already changed)
            if ($label->getAddress() === $this) {
                $label->setAddress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Provider[]
     */
    public function getProviders(): Collection
    {
        return $this->providers;
    }

    public function addProvider(Provider $provider): self
    {
        if (!$this->providers->contains($provider)) {
            $this->providers[] = $provider;
            $provider->setAddress($this);
        }

        return $this;
    }

    public function removeProvider(Provider $provider): self
    {
        if ($this->providers->contains($provider)) {
            $this->providers->removeElement($provider);
            // set the owning side to null (unless already changed)
            if ($provider->getAddress() === $this) {
                $provider->setAddress(null);
            }
        }

        return $this;
    }
}
