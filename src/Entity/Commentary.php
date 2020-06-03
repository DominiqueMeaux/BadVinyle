<?php

namespace App\Entity;

use App\Repository\CommentaryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaryRepository::class)
 */
class Commentary
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="comm_id")
     */
    private $comm_id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $comm_comment;

    /**
     * @ORM\Column(type="integer")
     */
    private $comm_note;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentaries")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Products::class, inversedBy="commentaries")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="prod_id")
     */
    private $product;

    public function getCommId(): ?int
    {
        return $this->comm_id;
    }

    public function getCommComment(): ?string
    {
        return $this->comm_comment;
    }

    public function setCommComment(string $comm_comment): self
    {
        $this->comm_comment = $comm_comment;

        return $this;
    }

    public function getCommNote(): ?int
    {
        return $this->comm_note;
    }

    public function setCommNote(int $comm_note): self
    {
        $this->comm_note = $comm_note;

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

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): self
    {
        $this->product = $product;

        return $this;
    }
}
