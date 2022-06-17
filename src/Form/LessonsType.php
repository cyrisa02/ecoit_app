<?php

namespace App\Form;

use App\Entity\Lessons;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class LessonsType extends AbstractType
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
                'label' => 'Contenu de la leçon'

            ])
            ->add('slug',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Donnez votre nom et prénom'

            ])
            ->add('video')
            ->add('is_ended',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Validation'
            ])
            //->add('created_at')
            //->add('updated_at')
            ->add('sections')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lessons::class,
        ]);
    }
}