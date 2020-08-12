<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
