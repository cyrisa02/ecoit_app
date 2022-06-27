<?php

namespace App\Form;

use App\Entity\Lessons;
use App\Entity\Sections;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('video', FileType::class, [
                'label' => 'Votre vidéo (mpeg4 file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            
                            'image/png',
                            'image/jpg',
                            
                        ],
                        'mimeTypesMessage' => 'Please upload a valid mpeg4 video',
                    ])
                ],
            ])
            ->add('is_ended',CheckboxType::class, [
                'mapped' => true,
                'label' => 'Validation'
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lessons::class,
        ]);
    }
}