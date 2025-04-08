<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CsvUploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('csv_file', FileType::class, [
            'label' => 'Archivo CSV',
            'mapped' => false,
            'required' => true,
            'attr' => [
                'accept' => '.csv'
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Subir CSV',
            'attr' => [
                'class' => 'btn btn-primary mt-3'
            ]
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
