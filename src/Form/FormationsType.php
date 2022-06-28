<?php

namespace App\Form;

use App\Entity\Sections;
use App\Entity\Formations;
use App\Repository\SectionsRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                'label' => 'Saisissez votre nom et votre prénom'

            ])
            ->add('is_endedFormation',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Valider la formation'
            ])
            ->add('is_Favorite',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Favoris'
            ])
            //->add('created_at')
            //->add('updated_at')

             ->add('sections', EntityType::class, [
                 'class' => Sections::class,
                'label'=> "Choisissez les sections",
                 'label_attr' => [
                     'class' => 'form-label mt-4'
                 ],
                  'choice_label' => 'title',
                 'multiple' => true,
                  'expanded' => true,
             ])
            




            //->add('directories')

            // ->add('directories', ChoiceType::class, [
            //     'attr' => [
            //         'class' => 'form-control'
            //     ],
            //     'label' => 'Catalogue de formation'

            // ] )
            // ->add('imageFile', VichImageType::class, [
            //     'label' => 'Image de la formation',
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //     ],
            //     'required' => false
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formations::class,
        ]);
    }
}