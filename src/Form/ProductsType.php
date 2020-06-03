<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prod_name', null, ['label'=>'nom'])
            ->add('prod_descr', TextareaType::class, ['label'=>'description', 'attr'=> ['class'=>'tinymce']])
            ->add('prod_price', null, ['label'=>'prix'])
            ->add('prod_display', null, ['label'=>'afficher le produit'])
            ->add('prod_stock', null, ['label'=>'en stock'])
            ->add('group', null, ['label'=>'groupe'])
            ->add('category', null, ['label'=>'categorie'])
            ->add('label', null, ['label'=>'label'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
    
}
