<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;
use App\Entity\Qualite;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
        'attr' => ['class' => 'form-control'] // <== Bootstrap
    ])
            ->add('price', NumberType::class, [
        'attr' => ['class' => 'form-control'] // <== Bootstrap
    ])
            ->add('qualite', EntityType::class, [
        'class' => Qualite::class,
        'choice_label' => 'libelle',
        'required' => false,
        'placeholder' => 'Sélectionner',
        'attr' => ['class' => 'form-select']
    ])
            ->add('image', FileType::class, [
        'mapped' => false,
        'required' => false,
        'attr' => ['class' => 'form-control']
    ])
            ->add('category', EntityType::class, [
        'class' => Category::class,
        'choice_label' => 'libelle',
        'attr' => ['class' => 'form-select'] // <== Bootstrap
    ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
