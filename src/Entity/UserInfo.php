<?php

namespace App\Entity;

use App\Repository\UserInfoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserInfoRepository::class)
 * @ORM\Table(name="user_info")
 */
class UserInfo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="user_info_id")
     */
    private $user_info_id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $user_info_registration_number;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="user_info")
     */
    private $info;

    
    public function __construct()
    {
        $this->info = new ArrayCollection();
        
    }

    public function getUserInfoId(): ?int
    {
        return $this->user_info_id;
    }

    public function getUserInfoRegistrationNumber(): ?string
    {
        return $this->user_info_registration_number;
    }

    public function setUserInfoRegistrationNumber(string $user_info_registration_number): self
    {
        $this->user_info_registration_number = $user_info_registration_number;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getInfo(): Collection
    {
        return $this->info;
    }

    public function addInfo(User $info): self
    {
        if (!$this->info->contains($info)) {
            $this->info[] = $info;
            $info->setUserInfo($this);
        }

        return $this;
    }

    public function removeInfo(User $info): self
    {
        if ($this->info->contains($info)) {
            $this->info->removeElement($info);
            // set the owning side to null (unless already changed)
            if ($info->getUserInfo() === $this) {
                $info->setUserInfo(null);
            }
        }

        return $this;
    }

    
}
