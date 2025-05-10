<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
            'label' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Correo electrónico',
            ],
            'row_attr' => ['class' => 'input-group input-group-lg mb-3'],
        ])
        ->add('plainPassword', PasswordType::class, [
            'label' => false,
            'mapped' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Contraseña',
            ],
            'row_attr' => ['class' => 'input-group input-group-lg mb-3'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Por favor ingrese una contraseña',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'La contraseña debe tener al menos {{ limit }} caracteres',
                    'max' => 16,
                ]),
            ],
        ])
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'label' => '    Aceptar términos',
            'constraints' => [
                new IsTrue([
                    'message' => 'Debes aceptar los términos.',
                ]),
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
