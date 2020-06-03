<?php

namespace App\Services;

use App\Entity\User;
use App\Entity\Token;
use Twig\Environment;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;




class TokenSendler
{
    private $mailer;
    private $twig;
     
    public function  __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }
    public function sendToken(User $user, Token $token){
        $message = (new Email('Comfirmez votre inscription'))
            ->from('noreply@bad-vinyl.com')
            ->to($user->getEmail())
            ->subject(
                $this->twig->render(
                    'emails/register.html.twig',
                    ['token' => $token->getValue()]
                ),
                'text/html'
            );
            $this->mailer->send($message);
    }
}