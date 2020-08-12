<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Products;
use App\Form\ProductsType;
use App\Form\SearchType;
use App\Repository\ProductsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/products")
 */

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products", methods={"GET"})
     */

    public function index(ProductsRepository $productsRepository, Request $request): Response
    {
        // Initialisation des données de recherches
        $data = new searchData();
        $data->page = $request->get('page', 1);
        
        //Création du formulaire avec la class SearchType avec en second paramètres les données
        $form = $this->createForm(SearchType::class, $data);
        // Gestion de la soumission du formulaire
        $form->handleRequest($request);
        $products = $productsRepository->findSearch($data);
        
    
        // $products = $paginatorInterface->paginate(
        //     $productsRepository->findAllWithPagination(), /* query NOT result */
        //     $request->query->getInt('page', 1), /*page number*/
        //     8 /*limit per page*/
        //);

        return $this->render('products/index.html.twig', [
            'products' => $products,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="products_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $product = new Products();
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('products');
        }

        return $this->render('products/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{prod_id}", name="products_show", methods={"GET"})
     */
    public function show(Products $product): Response
    {
        return $this->render('products/show.html.twig', [
            'product' => $product,
        ]);
    }


    public function edit(Request $request, Products $product): Response
    {
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('products');
        }

        return $this->render('products/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }


    public function delete(Request $request, Products $product): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('products');
    }
}
