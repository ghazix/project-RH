<?php

namespace backBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RangeType;


class GrilleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('tarifPaie')
            ->add('tarifDucs')
            ->add('tarifEntree')
            ->add('tarifSortie')
            ->add('tarifAttest')

            ->add('bMin', RangeType::class, [
                'attr' => [
                    "data-provide" => "slider",
                    "data-slider-ticks" => "[10, 50, 100, 150]",
                    "data-slider-ticks-labels" => '["10", "50", "100", "150"]',
                    "data-slider-min" => "1",
                    "data-slider-max" => "4",
                    "data-slider-step" => "1",
                    "data-slider-value" => "2",
                    "data-slider-tooltip" => "hide",
                    "style" => "width:100%;"
                ]
            ])
            ->add('bMax', RangeType::class, [
                'attr' => [
                    "data-provide" => "slider",
                    "data-slider-ticks" => "[10, 50, 100, 150]",
                    "data-slider-ticks-labels" => '["10", "50", "100", "150"]',
                    "data-slider-min" => "1",
                    "data-slider-max" => "4",
                    "data-slider-step" => "1",
                    "data-slider-value" => "2",
                    "data-slider-tooltip" => "hide",
                    "style" => "width:100%;"
                ]
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'backBundle\Entity\Grille'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backbundle_grille';
    }


}
