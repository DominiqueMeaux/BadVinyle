<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 * @UniqueEntity(fields={"user_id", "product_id"})
 */
class Cart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cart_number;

    /**
     * @ORM\Column(type="date")
     */
    private $cart_create_date;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="carts")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="prod_id")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="carts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCartNumber(): ?int
    {
        return $this->cart_number;
    }

    public function setCartNumber(int $cart_number): self
    {
        $this->cart_number = $cart_number;

        return $this;
    }

    public function getCartCreateDate(): ?\DateTimeInterface
    {
        return $this->cart_create_date;
    }

    public function setCartCreateDate(\DateTimeInterface $cart_create_date): self
    {
        $this->cart_create_date = $cart_create_date;

        return $this;
    }

    public function getProducts(): ?Products
    {
        return $this->products;
    }

    public function setProducts(?Products $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
