<?php

namespace App\Entity;

use App\Repository\TypePromoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypePromoRepository::class)
 * @ORM\Table(name="type_promo")
 */
class TypePromo {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="type_promo_id")
     */
    private $type_promo_id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $type_promo_libelle;

    /**
     * @ORM\OneToMany(targetEntity=Promotions::class, mappedBy="type_promo")
     */
    private $promotions;

    public function __construct()
    {
        $this->promotions = new ArrayCollection();
    }

    public function getTypePromoId(): ?int {
        return $this->type_promo_id;
    }

    public function getTypePromoLibelle(): ?string {
        return $this->type_promo_libelle;
    }

    public function setTypePromoLibelle(string $type_promo_libelle): self {
        $this->type_promo_libelle = $type_promo_libelle;

        return $this;
    }

    /**
     * @return Collection|Promotions[]
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotions $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions[] = $promotion;
            $promotion->setTypePromo($this);
        }

        return $this;
    }

    public function removePromotion(Promotions $promotion): self
    {
        if ($this->promotions->contains($promotion)) {
            $this->promotions->removeElement($promotion);
            // set the owning side to null (unless already changed)
            if ($promotion->getTypePromo() === $this) {
                $promotion->setTypePromo(null);
            }
        }

        return $this;
    }

}
