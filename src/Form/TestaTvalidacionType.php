<?php

namespace App\Form;

use App\Entity\TestaTtestamento;
use App\Entity\TestaTvalidacion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestaTvalidacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num_validacion')
            ->add('validaciones')
            ->add('id_testamento', EntityType::class, [
                'class' => TestaTtestamento::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TestaTvalidacion::class,
        ]);
    }
}
