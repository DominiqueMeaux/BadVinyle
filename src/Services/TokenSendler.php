<?php

namespace App\Services;

use App\Entity\User;
use App\Entity\Token;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;




class TokenSendler
{
    private $mailer;
    
     
    public function  __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        
    }
    public function sendToken(User $user, Token $token){
        
        $message = (new TemplatedEmail())
            ->from('noreply@bad-vinyl.com')
            ->to(new Address($user->getEmail()))
            ->subject('Merci pour votre inscription'
            )
                    ->htmlTemplate(
                        'emails/register.html.twig',
                        
                    )
                    ->context(
                        ['token' => $token->getValue()]

                    );
            $this->mailer->send($message);
    }
}