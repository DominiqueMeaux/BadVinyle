<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Token;
use App\Form\RegisterType;
use App\Services\TokenSendler;
use App\Repository\TokenRepository;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        if($form->handleRequest($request)->isSubmitted() && $form->isValid()){

            $passwordEncoded = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($passwordEncoded);
            $user->setRoles(['ROLE_ADMIN']);
            $token = new Token($user);
            $manager->persist($token);
            $manager->flush();
            $tokenSendler->sendToken($user, $token);

            $this->addFlash(
                'notice',
                "Un email de confirmation vous a été envoyé"
            );

            return $this->redirectToRoute('home');

        }
        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);

        }


    /**
     * @Route("/confirm/{token}", name="token_validate")
     */
    public function validateToken($token, TokenRepository $tokenRepository, EntityManagerInterface $manager, 
    GuardAuthenticatorHandler $guardAuthenticatorHandler, LoginFormAuthenticator $loginFormAuthenticator, Request $request)
    {

        $token = $tokenRepository->findOneBy(['value' => $token]);
        if(null === $token){
            throw new NotFoundHttpException();
        }
        $user = $token->getUser();
        if($token->isValid()) {
            $user = $token->getUser();

            $user->setEnable(true);
            $manager->flush($user);

            return $guardAuthenticatorHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $loginFormAuthenticator,
                'main'
            );
        }
            $manager->remove($user);
            $manager->remove($token);
            $this->addFlash(
                'notice',
                "Le token est expiré"
            );
            return $this->redirectToRoute('register');
    }



    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
