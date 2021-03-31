<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\Source;
use App\Entity\CourseType;
use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('extrainfo')
            ->add('adjustments')
            ->add('ingredient', EntityType::class, [
                'class'=>Ingredient::class,
                'choice_label'=> 'name',
                'multiple' => true,
            ])
            ->add('CourseType', EntityType::class,[
                'class' => CourseType::class,
                'label'=> 'Type de plat',
                'choice_label'=>'name',

                ])
            ->add('source', EntityType::class, [
                'class'=>Source::class,
                    'label' => 'Source de la recette',
                    'choice_label' => 'name',
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
