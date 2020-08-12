<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('userLastname', TextType::class, [
            'label' => 'Nom : ', 'attr' => [
                'class' => 'col-4'
            ]
        ])
        ->add('userFirstname', TextType::class, [
            'label' => 'Prénom : ', 'attr' => [
                'class' => 'col-4'
            ]
        ])
        ->add('email', EmailType::class, [
            'label' => 'Adresse mail : ', 'attr' => [
                'class' => 'col-4'
            ]
        ])
        ->add('userSexe', ChoiceType::class, [
            'choices'  => [
                'Homme' => 0,
                'Femme' => 1,
            ],
            'label' => 'Sexe : ', 'attr' => [
                'class' => 'col-1'
            ]
        ])
        ->add('userBirthday', DateType::class, [
            'label' => 'Date de naissance', 'attr' => [
                'class' => 'col-4 js-datepicker'
            ], 'widget' => 'single_text',
        ])
        ->add('userPhone', TelType::class, [
            'label' => 'Téléphone :', 'attr' => [
                'class' => 'col-4'
            ]
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Vous n\'avez pas saisi le même mot de passe!',
            'first_options' => [
                'label' => 'Mot de passe : ',
                'attr' => [
                    'class' => 'col-4'
                ]
            ],
            'second_options' => [
                'label' => 'Confirmez le mot de passe : ',
                'attr' => [
                    'class' => 'col-4 form-control'
                ]
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }


    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         'data_class' => User::class,
    //         'csrf_protection' => true,
    //         'csrf_field_name' => '_token',
    //         // a unique key to help generate the secret token
    //         'csrf_token_id' => 'task_item',
    //     ]);
    // }
}
