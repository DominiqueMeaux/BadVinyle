<?php

namespace App\Entity;

use App\Repository\ProductsOrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProductsOrderRepository::class)
 * @UniqueEntity(fields={"order_id", "product_id"})
 */
class ProductsOrder
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $order_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $products_number;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="productsOrders")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="prod_id")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="productsOrders")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="order_id")
     */
    private $order;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderPrice(): ?float
    {
        return $this->order_price;
    }

    public function setOrderPrice(float $order_price): self
    {
        $this->order_price = $order_price;

        return $this;
    }

    public function getProductsNumber(): ?int
    {
        return $this->products_number;
    }

    public function setProductsNumber(int $products_number): self
    {
        $this->products_number = $products_number;

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

    public function getOrdre(): ?Order
    {
        return $this->ordre;
    }

    public function setOrdre(?Order $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }
}
