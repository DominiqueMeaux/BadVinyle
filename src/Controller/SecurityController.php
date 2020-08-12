<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Token;
use App\Form\RegisterType;
use App\Services\TokenSendler;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(
    
        Request $request, 
        EntityManagerInterface $manager, 
        GuardAuthenticatorHandler $guardAuthenticatorHandler, 
        LoginFormAuthenticator $loginFormAuthenticator, 
        UserPasswordEncoderInterface $passwordEncoder, 
        TokenSendler $tokenSendler
        ) {
            
            // Création de l'utilisateur
            $user = new User();
            // Création du formulaire d'inscription
            $form = $this->createForm(RegisterType::class, $user);
            
            
            
            // Si le formulaire est soumis et validé
            if($form->handleRequest($request)->isSubmitted() && $form->isValid()){
                // Encodage du password ...
                $passwordEncoded = $passwordEncoder->encodePassword($user, $user->getPassword());
                $user->setPassword($passwordEncoded);
                //Attribution de rôle
                $user->setRoles(['ROLE_USER']);
                // D'un token
                $token = new Token($user);
                // On persist le token
                $manager->persist($token);
            
            //on enregistre le token et l'utilisateur en bd (cascade)
            $manager->flush();
            // Utilisation de la méthode du Services de mail
            $tokenSendler->sendToken($user, $token);
            // Message 
            $this->addFlash(
                'notice',
                "Un email de confirmation vous a été envoyé"
            );
            
            return $this->redirectToRoute('products');
            
        }
        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
            ]);
                
        }


    /**
     * @Route("/confirm/{value}", name="token_validate")
     */
    public function validateToken(Token $token, EntityManagerInterface $manager, 
    GuardAuthenticatorHandler $guardAuthenticatorHandler, LoginFormAuthenticator $loginFormAuthenticator, Request $request)
    {

       
        $user = $token->getUser();
        if($user->getEnable()){
            $this->addFlash(
                'notice',
                "Ce token est déjà validé !"
            );
            return $this->redirectToRoute('products');
        }

        if($token->isValid()) {
            $user = $token->getUser();
            $user->setEnable(true);
            $manager->flush();

            return $guardAuthenticatorHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $loginFormAuthenticator,
                'main'
            );
        }
        // Remove du token ( remove l'utilisateur en même temps, cascade)
            $manager->remove($token);
            $this->addFlash(
                'notice',
                "Le token est expiré, inscrivez-vous de nouveau"
            );
            return $this->redirectToRoute('register');
    }



    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Response
    {
        return $this->redirectToRoute('index');
    }
}
