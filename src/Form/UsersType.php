<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            //->add('roles')
            ->add('password')
            ->add('lastname')
            ->add('firstname')
            ->add('decription')
            ->add('picture')
            ->add('pseudo')
            //->add('created_at')
            //->add('updated_at')
            ->add('is_verified')
            ->add('is_validInstructor')
            ->add('reset_token')
            //->add('plainPassword')
            ->add('directories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}