<?php

namespace App\Form;

use App\Entity\TestaTimagen;
use App\Entity\TestaTnotario;
use App\Entity\TestaTparentesco;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('anno')
            ->add('mes')
            ->add('dia')
            ->add('mancomunado', CheckboxType::class, [
                'label'    => '¿Mancomunado?',
                'required' => false,
            ])            
            ->add('textoilegible', CheckboxType::class, [
                'label'    => '¿Texto ilegible?',
                'required' => false,
            ])            
            ->add('num_protocolo')
            ->add('num_folio')
            ->add('poblacion', EntityType::class, [
                'class' => TestaTpoblacion::class,
                'choice_label' => 'des_poblacion',
            ])
            ->add('notario', EntityType::class, [
                'class' => TestaTnotario::class,
                'choice_label' => 'des_notario',
            ])
            ->add('parentesco', EntityType::class, [
                'class' => TestaTparentesco::class,
                'choice_label' => 'des_parentesco',
            ])
                
            ->add('imagen', EntityType::class, [
                'class' => TestaTimagen::class,
                'choice_label' => 'des_imagen',
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
