<?php

namespace App\Form;

use App\Entity\EndedLessons;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EndedLessonsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('created_at')
            //->add('updated_at')
            ->add('users')
            ->add('lessons')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EndedLessons::class,
        ]);
    }
}