<?php

namespace App\Entity;

use App\Repository\CoefPriceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoefPriceRepository::class)
 * @ORM\Table(name="coef_price")
 */
class CoefPrice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="coef_id")
     */
    private $coef_id;

    /**
     * @ORM\Column(type="float")
     */
    private $coef_price;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="coef_price")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=UserType::class, mappedBy="coef_price")
     */
    private $userTypes;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->userTypes = new ArrayCollection();
    }

    public function getCoefId(): ?int
    {
        return $this->coef_id;
    }

    public function getCoefPrice(): ?float
    {
        return $this->coef_price;
    }

    public function setCoefPrice(float $coef_price): self
    {
        $this->coef_price = $coef_price;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCoefPrice($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCoefPrice() === $this) {
                $user->setCoefPrice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserType[]
     */
    public function getUserTypes(): Collection
    {
        return $this->userTypes;
    }

    public function addUserType(UserType $userType): self
    {
        if (!$this->userTypes->contains($userType)) {
            $this->userTypes[] = $userType;
            $userType->setCoefPrice($this);
        }

        return $this;
    }

    public function removeUserType(UserType $userType): self
    {
        if ($this->userTypes->contains($userType)) {
            $this->userTypes->removeElement($userType);
            // set the owning side to null (unless already changed)
            if ($userType->getCoefPrice() === $this) {
                $userType->setCoefPrice(null);
            }
        }

        return $this;
    }
}
