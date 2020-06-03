<?php

namespace App\Entity;

use App\Repository\OrderStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderStatusRepository::class)
 * @ORM\Table(name="order_status")
 */
class OrderStatus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $order_status_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $order_status_lib;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="status")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getStatusId(): ?int
    {
        return $this->order_status_id;
    }

    public function getOrderStatusLib(): ?string
    {
        return $this->order_status_lib;
    }

    public function setOrderStatusLib(string $order_status_lib): self
    {
        $this->order_status_lib = $order_status_lib;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setStatus($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getStatus() === $this) {
                $order->setStatus(null);
            }
        }

        return $this;
    }
}
