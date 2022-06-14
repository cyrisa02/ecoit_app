<?php

namespace App\Form;

use App\Entity\Formations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class FormationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Titre'

            ])
            ->add('description',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Description'

            ] )
            ->add('slug',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Slug'

            ])
            ->add('is_endedFormation',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Terminée'
            ])
            ->add('is_Favorite',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Favoris'
            ])
            //->add('created_at')
            //->add('updated_at')
            //->add('users')
            ->add('images')
            ->add('directories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formations::class,
        ]);
    }
}