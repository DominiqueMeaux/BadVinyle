<?php

namespace App\Entity;

use App\Repository\TypeProviderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeProviderRepository::class)
 * @ORM\Table(name="type_provider")
 */
class TypeProvider
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer" , name="type_prov_id")
     */
    private $type_prov_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type_prov_libelle;

    /**
     * @ORM\OneToMany(targetEntity=Provider::class, mappedBy="type_provider")
     */
    private $providers;

    public function __construct()
    {
        $this->providers = new ArrayCollection();
    }

    public function getTypeProvId(): ?int
    {
        return $this->type_prov_id;
    }

    public function getTypeProvLibelle(): ?string
    {
        return $this->type_prov_libelle;
    }

    public function setTypeProvLibelle(string $type_prov_libelle): self
    {
        $this->type_prov_libelle = $type_prov_libelle;

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
            $provider->setTypeProvider($this);
        }

        return $this;
    }

    public function removeProvider(Provider $provider): self
    {
        if ($this->providers->contains($provider)) {
            $this->providers->removeElement($provider);
            // set the owning side to null (unless already changed)
            if ($provider->getTypeProvider() === $this) {
                $provider->setTypeProvider(null);
            }
        }

        return $this;
    }
}
