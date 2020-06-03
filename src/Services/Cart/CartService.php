<?php

namespace App\Services\Cart;

use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService {

     protected $session;
     protected $productsRepository;

     public function __construct (SessionInterface $session, ProductsRepository $productsRepository)
     {
        $this->session = $session;
        $this->productsRepository = $productsRepository;
     }

    public function add( int $id)
    {
        $cart = $this->session->get('panier', []);
        if (!empty($cart[$id])) {

            $cart[$id]++;
        } else {

            $cart[$id] = 1;
        }
        $this->session->set('panier', $cart);
    }


    public function remove( int $id)
    {
        $cart = $this->session->get('panier', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        $this->session->set('panier', $cart);
    }


    public function getFullCart() : array 
    {
        $cart = $this->session->get('panier', []);
        $cartWithData = [];
        foreach ($cart as $id => $quantity) {
            $cartWithData[] = [
                'product' => $this->productsRepository->find($id),
                'quantity' => $quantity
            ];
        }
        return $cartWithData;
    }


    public function getTotal() : float 
    {
        $total = 0;
        $cartWithData = $this->getFullCart();

        foreach ($this->getFullCart() as $item) {
            $totalItem = $item['product']->getProdPrice() * $item['quantity'];
            $total += $totalItem;
        }
        return $total;
    }
}