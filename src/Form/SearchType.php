<?php 

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{

    // Construction du formulaire
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        // Barre de recherche
            ->add('q', TextType::class,[
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher'
                ]
            ])

        // Recherche des catégories par rapport à l entity Categories
            ->add('categories', EntityType::class, [
            'label' => false,
            'required' => false,
            'class' => Categories::class,
            // Liste de checkbox expanded et multiple à true 
            'expanded' => true,
            'multiple' =>true
            ])

            // Par prix min
            ->add('min', NumberType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Prix min'
            ]
            ])

            // Par prix max
            ->add('max', NumberType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Prix max'
            ]
            ])


            // Par promo
            ->add('promo', CheckboxType::class, [
            'label' => 'En promotion',
            'required' => false,
            ])
            ;
    }

    // Configuration des différentes options liée au formulaire
    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}