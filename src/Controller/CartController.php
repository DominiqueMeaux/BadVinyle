<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_index")
     */
    public function index(SessionInterface $session, ProductsRepository $productsRepository)
    {
        $cart = $session->get('panier', []);
        $cartWithData = [];
        foreach($cart as $id => $quantity){
            $cartWithData[] = [
                'product' => $productsRepository->find($id),
                'quantity' => $quantity
            ];
        }

        $total = 0;

        foreach($cartWithData as $item){
            $totalItem = $item['product']->getProdPrice() * $item['quantity'];
            $total += $totalItem;
        }
        
        return $this->render('cart/index.html.twig', [
           'items' => $cartWithData,
           'total' => $total
        ]);
    }


    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id, SessionInterface $session){
        
        $cart = $session->get('panier', []);
        if (!empty($cart[$id])){

            $cart[$id]++;

        }else{

        $cart[$id] = 1;
        }
        $session->set('panier', $cart);

        return $this->redirectToRoute("home");
        

    }


    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, SessionInterface $session){
        $cart = $session->get('panier', []);

        if(!empty($cart[$id])){
            unset($cart[$id]);
        }
        $session->set('panier', $cart);
        return $this->redirectToRoute("cart_index");
    }
}
