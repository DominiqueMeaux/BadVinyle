<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController {

    /**
     * @Route("/user", name="user")
     */
    public function index(UserRepository $userRepository) {
        return $this->render('user/index.html.twig', [
                    'user' => $userRepository->findAll(),
        ]);
    }

}
