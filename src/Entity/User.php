<?php

namespace App\Entity;


use App\Entity\UserInfo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $user_lastname;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $user_firstname;

    /**
     * @ORM\Column(type="date")
     */
    private $user_birthday;

    /**
     * @ORM\Column(type="boolean")
     */
    private $user_sexe;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $user_phone;

    /**
     * @ORM\Column(type="date")
     */
    private $user_register_date;

    /**
     * @ORM\ManyToOne(targetEntity=UserInfo::class, inversedBy="info")
     * @ORM\JoinColumn(name="user_info_id", referencedColumnName="user_info_id")
     */
    private $user_info;

    /**
     * @ORM\ManyToOne(targetEntity=UserType::class, inversedBy="users")
     * @ORM\JoinColumn(name="user_type_id", referencedColumnName="user_type_id")
     */
    private $user_type;

    /**
     * @ORM\OneToMany(targetEntity=Commentary::class, mappedBy="user")
     */
    private $commentaries;

    /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="user")
     */
    private $carts;



    /**
     * @ORM\column(type="boolean")
     */
    private $enable = false;


    /**
     * @ORM\ManyToMany(targetEntity="Address")
     * @ORM\JoinTable(name="user_adresses",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="address_id")}
     *      )
     */


    private $addresses;

    
    
    public function __construct()
    {
        $this->commentaries = new ArrayCollection();
        $this->carts = new ArrayCollection();
        $this->user_register_date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->user_id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): self
    {
        $this->enable = $enable;

        return $this;
    }

    public function getUserLastname(): ?string
    {
        return $this->user_lastname;
    }

    public function setUserLastname(string $user_lastname): self
    {
        $this->user_lastname = $user_lastname;

        return $this;
    }

    public function getUserFirstname(): ?string
    {
        return $this->user_firstname;
    }

    public function setUserFirstname(string $user_firstname): self
    {
        $this->user_firstname = $user_firstname;

        return $this;
    }

    public function getUserBirthday(): ?\DateTimeInterface
    {
        return $this->user_birthday;
    }

    public function setUserBirthday(\DateTimeInterface $user_birthday): self
    {
        $this->user_birthday = $user_birthday;

        return $this;
    }

    public function getUserSexe(): ?bool
    {
        return $this->user_sexe;
    }

    public function setUserSexe(bool $user_sexe): self
    {
        $this->user_sexe = $user_sexe;

        return $this;
    }

    public function getUserPhone(): ?string
    {
        return $this->user_phone;
    }

    public function setUserPhone(string $user_phone): self
    {
        $this->user_phone = $user_phone;

        return $this;
    }

    public function getUserRegisterDate(): ?\DateTimeInterface
    {
        return $this->user_register_date;
    }

    public function setUserRegisterDate(\DateTimeInterface $user_register_date): self
    {
        $this->user_register_date = $user_register_date;

        return $this;
    }

    public function getUserInfo(): ?UserInfo
    {
        return $this->user_info;
    }

    public function setUserInfo(?UserInfo $user_info): self
    {
        $this->user_info = $user_info;

        return $this;
    }
    /**
     * @return Collection|Commentary[]
     */
    public function getCommentaries(): Collection
    {
        return $this->commentaries;
    }

    public function addCommentary(Commentary $commentary): self
    {
        if (!$this->commentaries->contains($commentary)) {
            $this->commentaries[] = $commentary;
            $commentary->setUser($this);
        }

        return $this;
    }

    public function removeCommentary(Commentary $commentary): self
    {
        if ($this->commentaries->contains($commentary)) {
            $this->commentaries->removeElement($commentary);
            // set the owning side to null (unless already changed)
            if ($commentary->getUser() === $this) {
                $commentary->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setUser($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->contains($cart)) {
            $this->carts->removeElement($cart);
            // set the owning side to null (unless already changed)
            if ($cart->getUser() === $this) {
                $cart->setUser(null);
            }
        }

        return $this;
    }

    
}
