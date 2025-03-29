<?php

namespace App\Form;

use App\Entity\TestaTimagen;
use App\Entity\TestaTnotario;
use App\Entity\TestaTparentesco;
use App\Entity\TestaTpoblacion;
use App\Entity\TestaTtestamento;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestaTtestamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id')
            ->add('anno')
            ->add('mes')
            ->add('dia')
            ->add('mancomunado')
            ->add('textoilegible')
            ->add('num_protocolo')
            ->add('num_folio')
            ->add('id_poblacion', EntityType::class, [
                'class' => TestaTpoblacion::class,
                'choice_label' => 'id',
            ])
            ->add('id_notario', EntityType::class, [
                'class' => TestaTnotario::class,
                'choice_label' => 'id',
            ])
            ->add('id_parentesco', EntityType::class, [
                'class' => TestaTparentesco::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('id_imagen', EntityType::class, [
                'class' => TestaTimagen::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TestaTtestamento::class,
        ]);
    }
}
