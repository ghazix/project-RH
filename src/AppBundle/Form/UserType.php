<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
//use AppBundle\Form\DataTransformer\StringToArrayTransformer;




class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('nom')
                ->add('prenom')
                ->add('email')
                ->add('roles', ChoiceType::class, array(
                    'multiple' => true,
                    'choices' => array(
                        'Senior-manager' => 'ROLE_ADMIN',
                        'manager' => 'ROLE_MANAGER',
                        'senior' => 'ROLE_SENIOR',
                        'assistant' => 'ROLE_ASSISTANT',
                    ),
                    'required' => true
                ))
                ->add('senior')
                ->add('plainPassword')
                ->add('dateEntree', DateTimeType::class, [
                    'widget' => 'single_text'
                ])
                ->add('dateSortie', DateTimeType::class, [
                    'widget' => 'single_text'
                ])
                ->add('prixH')
                ->add('soldeO')
                ->add('moisS')
                ->add('aquis')
                ->add('superieur')
                ->add('etat')
                ->add('bur')
                ->add('dept');
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
