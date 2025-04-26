<?php

namespace App\Form;

use App\Entity\TestaTotorgante;
use App\Entity\TestaTtestamento;
use App\Entity\TestaTtestaotorgante;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestaTtestaotorganteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num_orden')
            ->add('id_testamento', EntityType::class, [
                'class' => TestaTtestamento::class,
                'choice_label' => 'id',
            ])
            ->add('id_otorgante', EntityType::class, [
                'class' => TestaTotorgante::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TestaTtestaotorgante::class,
        ]);
    }
}
