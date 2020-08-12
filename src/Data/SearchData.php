<?php 

namespace App\Data;


use App\Entity\Categories;

class SearchData
{


    /**
     * @var int
     */

     public $page = 1;


    /**
     * Undocumented variable
     *
     * @var string
     */
    private $q = '';


    /**
     * Undocumented variable
     *
     * @var Categories[]
     */
    private $categories =  [];


    /**
     * Undocumented variable
     *
     * @var null|integer
     */
    private $max;


    /**
     * Undocumented variable
     *
     * @var null|integer
     */
    private $min;


    /**
     * Undocumented variable
     *
     * @var bool
     */
    private $promo = false;




    public function getQ(): ?string
    {
        return $this->q;
    }

    public function setQ($q): self
    {
        $this->q = $q;

        return $this;
    }


    public function getCategories(): ?array
    {
        return $this->categories;
    }

    public function setCategories($categories): self
    {
        $this->categories = $categories;

        return $this;
    }


    public function getMax(): ?int
    {
        return $this->max;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }



    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }


    public function getPromo(): ?bool
    {
        return $this->promo;
    }

    public function setPromo($promo): self
    {
        $this->promo = $promo;

        return $this;
    }

}