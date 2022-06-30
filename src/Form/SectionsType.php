<?php

namespace App\Form;

use App\Entity\Quizes;
use App\Entity\Lessons;
use App\Entity\Sections;
use App\Entity\Formations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SectionsType extends AbstractType
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
            // ->add('formations', EntityType::class, [
            //     'class' => Formations::class,
            //     'label'=> "Choisissez les formations",
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //      ],
            //      'choice_label' => 'title',
            //      'multiple' => true,
            //      'expanded' => true,
            // ])
            ->add('quizes', EntityType::class, [
                'class' => Quizes::class,
                'label'=> "Choisissez le quiz",
                'label_attr' => [
                    'class' => 'form-label mt-4'
                 ],
                 'choice_label' => 'title',
                 'multiple' => true,
                 'expanded' => true,
            ])
            // ->add('lessons', EntityType::class, [
            //     'class' => Lessons::class,
            //     'label'=> "Choisissez les leçons",
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //      ],
            //      'choice_label' => 'title',
            //      'multiple' => true,
            //      'expanded' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sections::class,
        ]);
    }
}