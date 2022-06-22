<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Email'

            ])
            //->add('roles')
            ->add('password',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Mot de passe'

            ])
            ->add('lastname',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom '

            ])
            ->add('firstname',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom'

            ])
            ->add('decription',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Description'

            ])
            //->add('picture')
            
            ->add('pseudo')
            //->add('created_at')
            //->add('updated_at')
            ->add('is_verified',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Je certifie les données exactes'
            ])
            ->add('is_validInstructor',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Je suis d\'accord avec le RGPD du site'
            ])
            //->add('reset_token')
            //->add('plainPassword')
           // ->add('directories')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de la formation',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}