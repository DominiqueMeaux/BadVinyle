<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer",name="order_id")
     */
    private $order_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $order_date;

    /**
     * @ORM\Column(type="float")
     */
    private $order_totalprice;

    /**
     * @ORM\Column(type="datetime")
     */
    private $order_deliver_date;

    /**
     * @ORM\Column(type="float")
     */
    private $order_duty_free;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $order_bill_format;

    /**
     * @ORM\ManyToOne(targetEntity=OrderStatus::class, inversedBy="orders")
     * @ORM\JoinColumn(name="order_status_id", referencedColumnName="order_status_id")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=ProductsOrder::class, mappedBy="ordre")
     */
    private $productsOrders;

    public function __construct()
    {
        $this->productsOrders = new ArrayCollection();
    }

    public function getOrderId(): ?int {
        return $this->order_id;
    }

    public function setOrderId(int $order_id): self {
        $this->order_id = $order_id;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface {
        return $this->order_date;
    }

    public function setOrderDate(\DateTimeInterface $order_date): self {
        $this->order_date = $order_date;

        return $this;
    }

    public function getOrderTotalprice(): ?float {
        return $this->order_totalprice;
    }

    public function setOrderTotalprice(float $order_totalprice): self {
        $this->order_totalprice = $order_totalprice;

        return $this;
    }

    public function getOrderDeliverDate(): ?\DateTimeInterface {
        return $this->order_deliver_date;
    }

    public function setOrderDeliverDate(\DateTimeInterface $order_deliver_date): self {
        $this->order_deliver_date = $order_deliver_date;

        return $this;
    }

    public function getOrderDutyFree(): ?float {
        return $this->order_duty_free;
    }

    public function setOrderDutyFree(float $order_duty_free): self {
        $this->order_duty_free = $order_duty_free;

        return $this;
    }

    public function getOrderBillFormat(): ?string {
        return $this->order_bill_format;
    }

    public function setOrderBillFormat(string $order_bill_format): self {
        $this->order_bill_format = $order_bill_format;

        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(?OrderStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|ProductsOrder[]
     */
    public function getProductsOrders(): Collection
    {
        return $this->productsOrders;
    }

    public function addProductsOrder(ProductsOrder $productsOrder): self
    {
        if (!$this->productsOrders->contains($productsOrder)) {
            $this->productsOrders[] = $productsOrder;
            $productsOrder->setOrdre($this);
        }

        return $this;
    }

    public function removeProductsOrder(ProductsOrder $productsOrder): self
    {
        if ($this->productsOrders->contains($productsOrder)) {
            $this->productsOrders->removeElement($productsOrder);
            // set the owning side to null (unless already changed)
            if ($productsOrder->getOrdre() === $this) {
                $productsOrder->setOrdre(null);
            }
        }

        return $this;
    }

}
