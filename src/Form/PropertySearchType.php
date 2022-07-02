<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('listlesson',TextType::class, [
                'required'=>false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder'=> 'Liste des leçons en cours'
                ],
                'label' => false

            ])
            ->add('finishlesson',TextType::class, [
                'required'=>false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder'=> 'Liste des leçons terminées'
                ],
                'label' => false

            ])
            // ->add('submit', SubmitType::class, [
            //     'label' => 'Rechercher'
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}