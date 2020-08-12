<?php

namespace App\Controller;

use App\Entity\Products;
use App\Entity\Commentary;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommentaryController extends AbstractController
{
    /**
     * @Route("/commentary", name="commentary")
     */
    public function index()
    {
        return $this->render('commentary/index.html.twig', [
            'controller_name' => 'CommentaryController',
        ]);
    }

    
}
