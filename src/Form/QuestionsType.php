<?php

namespace App\Form;

use App\Entity\Quizes;
use App\Entity\Questions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class QuestionsType extends AbstractType
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
            ->add('question', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Ennoncez la question clairement'

            ])
            ->add('correction',TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Donnez sa correction'

            ])
            //->add('is_answer_ok')
            //->add('is_corrected')
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
        ]);
    }
}