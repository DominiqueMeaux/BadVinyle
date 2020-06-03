<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 * @ORM\Table(name="Products")
 */
class Products {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="prod_id")
     */
    private $prod_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prod_name;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $prod_descr;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $prod_price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $prod_display;

    /**
     * @ORM\Column(type="integer")
     */
    private $prod_stock;

    /**
     * @ORM\OneToMany(targetEntity=Commentary::class, mappedBy="product")
     */
    private $commentaries;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="products")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="group_id")
     */
    private $group;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="cat_id")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Promotions")
     * @ORM\JoinTable(name="promo_products",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="prod_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="promo_id", referencedColumnName="promo_id")}
     *      )
     */
    private $promotions;

    /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="products")
     */
    private $carts;

    /**
     * @ORM\OneToMany(targetEntity=ProductsOrder::class, mappedBy="products")
     */
    private $productsOrders;

    /**
     * @ORM\ManyToOne(targetEntity=Label::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false, name="label_siren", referencedColumnName="label_siren")
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity=Photo::class, inversedBy="products")
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="photo_id")
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Provider::class, inversedBy="products")
     * @ORM\JoinColumn(name="provider_siren", referencedColumnName="prov_siren")
     */
    private $provider;

    public function __construct() {
        $this->commentaries = new ArrayCollection();
        $this->promotions = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->productsOrders = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->prod_id;
    }

    public function getProdName(): ?string {
        return $this->prod_name;
    }

    public function setProdName(string $prod_name): self {
        $this->prod_name = $prod_name;

        return $this;
    }

    public function getProdDescr(): ?string {
        return $this->prod_descr;
    }

    public function setProdDescr(?string $prod_descr): self {
        $this->prod_descr = $prod_descr;

        return $this;
    }

    public function getProdPrice(): ?string {
        return $this->prod_price;
    }

    public function setProdPrice(string $prod_price): self {
        $this->prod_price = $prod_price;

        return $this;
    }

    public function getProdDisplay(): ?bool {
        return $this->prod_display;
    }

    public function setProdDisplay(bool $prod_display): self {
        $this->prod_display = $prod_display;

        return $this;
    }

    public function getProdStock(): ?int {
        return $this->prod_stock;
    }

    public function setProdStock(int $prod_stock): self {
        $this->prod_stock = $prod_stock;

        return $this;
    }

    /**
     * @return Collection|Commentary[]
     */
    public function getCommentaries(): Collection {
        return $this->commentaries;
    }

    public function addCommentary(Commentary $commentary): self {
        if (!$this->commentaries->contains($commentary)) {
            $this->commentaries[] = $commentary;
            $commentary->setProduct($this);
        }

        return $this;
    }

    public function removeCommentary(Commentary $commentary): self {
        if ($this->commentaries->contains($commentary)) {
            $this->commentaries->removeElement($commentary);
            // set the owning side to null (unless already changed)
            if ($commentary->getProduct() === $this) {
                $commentary->setProduct(null);
            }
        }

        return $this;
    }

    public function getGroup(): ?Group {
        return $this->group;
    }

    public function setGroup(?Group $group): self {
        $this->group = $group;

        return $this;
    }

    public function getPromotions(): ArrayCollection {
        return $this->promotions;
    }

    public function setPromotions(?Promotions $promotions): self {
        $this->promotions = $promotions;

        return $this;
    }

    public function getCategory(): ?Categories {
        return $this->category;
    }

    public function setCategory(?Categories $category): self {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts(): Collection {
        return $this->carts;
    }

    public function addCart(Cart $cart): self {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setProducts($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self {
        if ($this->carts->contains($cart)) {
            $this->carts->removeElement($cart);
            // set the owning side to null (unless already changed)
            if ($cart->getProducts() === $this) {
                $cart->setProducts(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProductsOrder[]
     */
    public function getProductsOrders(): Collection {
        return $this->productsOrders;
    }

    public function addProductsOrder(ProductsOrder $productsOrder): self {
        if (!$this->productsOrders->contains($productsOrder)) {
            $this->productsOrders[] = $productsOrder;
            $productsOrder->setProducts($this);
        }

        return $this;
    }

    public function removeProductsOrder(ProductsOrder $productsOrder): self {
        if ($this->productsOrders->contains($productsOrder)) {
            $this->productsOrders->removeElement($productsOrder);
            // set the owning side to null (unless already changed)
            if ($productsOrder->getProducts() === $this) {
                $productsOrder->setProducts(null);
            }
        }

        return $this;
    }

    public function getLabel(): ?Label {
        return $this->label;
    }

    public function setLabel(?Label $label): self {
        $this->label = $label;

        return $this;
    }

    public function getPhoto(): ?Photo
    {
        return $this->photo;
    }

    public function setPhoto(?Photo $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

}
