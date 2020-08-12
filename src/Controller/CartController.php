<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\TypeAddress;
use App\Entity\Address;
use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{

    /**
     * @Route("/commande", name="commande")
     */
public function comform(SessionInterface $Session)
{
    return $this->render("cart/commande.html.twig");
}

    /**
     * @Route("/traitementCommande", name="traitementCommande")
     */
public function traitementCommande(SessionInterface $session, Request $request)
{
    //Livraison
    $adresseLivraison = new Address();


    $adresseLivraison->setAddressCity($request->get('ville_livraison'));
    $adresseLivraison->setAddressCountry($request->get('pays_livraison'));
    $adresseLivraison->setAddressPostalCode($request->get('codePostal_livraison'));
    $adresseLivraison->setAddressStreet($request->get('adresse_livraison'));


    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($adresseLivraison);
    $entityManager->flush();

    //Facturation
    $adresseFacturation = new Address();

    $adresseFacturation->setAddressCity($request->get('ville_facturation'));
    $adresseFacturation->setAddressCountry($request->get('pays_facturation'));
    $adresseFacturation->setAddressPostalCode($request->get('codePostal_facturation'));
    $adresseFacturation->setAddressStreet($request->get('adresse_facturation'));

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($adresseFacturation);
    $entityManager->flush();

    $cart = $session->get('panier');
    $cartShopping = new Cart();

    $this ->getUser();
    $user = $session->getId();
    $nb = $user * 5;
    $cartNumber = $user . $nb   ;
    foreach ($item as $cart) {
        $cartShopping->setCartCreateDate(new \DateTime());
        $cartShopping->setTotalItem($item['quantity']);
        $cartShopping->setCartNumber($cartNumber);
        $cartShopping->setProducts();
    }



    return $this->redirectToRoute('commande');
}


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
        // id = id du produit
        if (!empty($cart[$id])){

            $cart[$id]++;

        }else{

        $cart[$id] = 1;
        }
        $session->set('panier', $cart);
        $this->addFlash(
            'notice',
            "Produit ajouté dans la panier"
        );
        return $this->redirectToRoute("products");
        

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
        $this->addFlash(
            'notice',
            "Produit retiré"
        );
        return $this->redirectToRoute("cart_index");
    }
}
