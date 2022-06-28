<?php

namespace App\Form;

use App\Entity\Quizes;
use App\Entity\Questions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class QuizesType extends AbstractType
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
            ->add('sections')

             ->add('questions', EntityType::class, [
                 'class' => Questions::class,

                // 'query_builder' => function (QuestionsRepository $r) {
                //     return $r->createQueryBuilder('i')
                //         ->where('i.user = :user')
                //         ->orderBy('i.name', 'ASC')
                //         ->setParameter('user', $this->token->getToken()->getUser());
                // },

             'label' => 'Sélectionner les questions pour le quiz',
               'label_attr' => [
                    'class' => 'form-label mt-4'
                 ],
                 'choice_label' => 'question',
                 'multiple' => true,
                 'expanded' => true,
             ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quizes::class,
        ]);
    }
}