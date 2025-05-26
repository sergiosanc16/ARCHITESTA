<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ValidacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('foto', TextType::class, [
                  'label' => 'Nombre de la imagen del testamento',
                  'empty_data' => 'nada',
                  'required' => false,
                 ])
            ->add('validar', SubmitType::class, [
                  'label' => 'Validacion',
                  'attr' => [
                      'class' => 'btn btn-primary mt-3'
                  ]
            ])
            ->add('tipo', ChoiceType::class, [
                'choices' => [
                    'foto' => 1,
                    'auto' => 2,
                ],
                'choice_label' => function ($choice, string $key, mixed $value): TranslatableMessage|string {
                    if (1 === $choice) {
                        return 'Validacion por foto';
                    }
                    if (2 ===$choice){
                        return 'Validacion automatica';
                    }
                    return strtoupper($key);
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}