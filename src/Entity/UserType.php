<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\CoefPrice;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserTypeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=UserTypeRepository::class)
 * @ORM\Table(name="user_type")
 */
class UserType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="user_type_id")
     */
    private $user_type_id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $user_type_libelle;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="user_type")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=CoefPrice::class, inversedBy="userTypes")
     * @ORM\JoinColumn(name="coef_id", referencedColumnName="coef_id")
     */
    private $coef_price;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getUserTypeId(): ?int
    {
        return $this->user_type_id;
    }

    public function getUserTypeLibelle(): ?string
    {
        return $this->user_type_libelle;
    }

    public function setUserTypeLibelle(string $user_type_libelle): self
    {
        $this->user_type_libelle = $user_type_libelle;

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
            $user->setUserType($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getUserType() === $this) {
                $user->setUserType(null);
            }
        }

        return $this;
    }

    public function getCoefPrice(): ?CoefPrice
    {
        return $this->coef_price;
    }

    public function setCoefPrice(?CoefPrice $coef_price): self
    {
        $this->coef_price = $coef_price;

        return $this;
    }
}
