<?php

namespace App\Entity;

use App\Repository\TypeAddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeAddressRepository::class)
 * @ORM\Table(name="type_address")
 */
class TypeAddress
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="type_address_id")
     */
    private $type_address_id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $type_address_libele;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="type_address")
     */
    private $addresses;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->type_address_id;
    }

    public function getTypeAddressLibele(): ?string
    {
        return $this->type_address_libele;
    }

    public function setTypeAddressLibele(string $type_address_libele): self
    {
        $this->type_address_libele = $type_address_libele;

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setTypeAddress($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getTypeAddress() === $this) {
                $address->setTypeAddress(null);
            }
        }

        return $this;
    }
}
