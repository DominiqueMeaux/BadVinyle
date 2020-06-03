<?php

namespace App\Entity;

use App\Repository\PromotionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionsRepository::class)
 * @ORM\Table(name="promotions")
 */
class Promotions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="promo_id")
     */
    private $promo_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $promo_percent;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $promo_libelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $promo_active;

    /**
     * @ORM\Column(type="datetime")
     */
    private $promo_date_fin;

    /**
     * @ORM\ManyToOne(targetEntity=TypePromo::class, inversedBy="promotions")
     * @ORM\JoinColumn(name="type_promo_id", referencedColumnName="type_promo_id")
     */
    private $type_promo;

    public function getPromoId(): ?int
    {
        return $this->promo_id;
    }

    public function setPromoId(int $promo_id): self
    {
        $this->promo_id = $promo_id;

        return $this;
    }

    public function getPromoPercent(): ?int
    {
        return $this->promo_percent;
    }

    public function setPromoPercent(int $promo_percent): self
    {
        $this->promo_percent = $promo_percent;

        return $this;
    }

    public function getPromoLibelle(): ?string
    {
        return $this->promo_libelle;
    }

    public function setPromoLibelle(string $promo_libelle): self
    {
        $this->promo_libelle = $promo_libelle;

        return $this;
    }

    public function getPromoActive(): ?bool
    {
        return $this->promo_active;
    }

    public function setPromoActive(bool $promo_active): self
    {
        $this->promo_active = $promo_active;

        return $this;
    }

    public function getPromoDateFin(): ?\DateTimeInterface
    {
        return $this->promo_date_fin;
    }

    public function setPromoDateFin(\DateTimeInterface $promo_date_fin): self
    {
        $this->promo_date_fin = $promo_date_fin;

        return $this;
    }

    public function getTypePromo(): ?TypePromo
    {
        return $this->type_promo;
    }

    public function setTypePromo(?TypePromo $type_promo): self
    {
        $this->type_promo = $type_promo;

        return $this;
    }
}
