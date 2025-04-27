<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType; // ¡Esta es la importación correcta!
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CsvUploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('csv_file', FileType::class, [
            'constraints' => [
            new File([
                'maxSize' => '25M',
                'mimeTypes' => [
                    'text/csv',
                    'text/plain',
                    'application/vnd.ms-excel',
                ],
                'mimeTypesMessage' => 'Por favor sube un fichero CSV válido (hasta 25 MB).',
        ]),
    ],
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
