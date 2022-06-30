<?php

namespace App\Form;

use App\Entity\Formations;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder            
            //->add('roles')
            //->add('password')            
            //->add('created_at')
            //->add('updated_at')
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'E-mail'
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom'

            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom'
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password',
                'class' => 'form-control'                
            ],
             'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
               
            ])
            ->add('decription', TextType::class, [
                  'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Présentez-vous en quelques mots'   
            ])
            // ->add('picture', TextType::class, [
            //      'attr' => [
            //         'class' => 'form-control'
            //     ],
            //     'label' => 'Photo'    
            // ])
            // ->add('imageFile', VichImageType::class, [
            //     'label' => 'Votre photo',
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //     ],
            //     'required' => false
            // ])
            ->add('pseudo', TextType::class, [
                 'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Votre pseudo'
            ])
            
            //->add('reset_token')
            //->add('directories')
            ->add('formations', EntityType::class, [
                'class' => Formations::class,
                'label'=> "Choisissez les formations",
                'label_attr' => [
                    'class' => 'form-check-label mt-4'
                 ],
                 'choice_label' => 'title',
                 'multiple' => true,
                 'expanded' => true,
            ])
            
            // ->add('RGPDConsent', CheckboxType::class, [
            //     'mapped' => false,
            //      'label' => 'Etes-vous d\'accord avec notre RGPD',
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'You should agree to our terms.',
            //         ]),
            //     ],
            // ])
            ->add('is_verified', CheckboxType::class, [
                'mapped' => false,
                 'label' => 'Etes-vous d\'accord avec notre RGPD',
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])

            // ->add('is_verified', CheckboxType::class, [
            //     'mapped' => true,
            //     'label' => 'En cours de vérification'
            // ])
            ->add('is_validInstructor',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Je certifie les données exactes'
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