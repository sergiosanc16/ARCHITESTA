<?php

namespace App\Form;

use App\Entity\TestaTraw;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestaTrawType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classificationId')
            ->add('year')
            ->add('month')
            ->add('day')
            ->add('otherPopulation')
            ->add('populationName')
            ->add('grantorSurname1')
            ->add('gratorSurname2')
            ->add('grantorName')
            ->add('officeMentioned')
            ->add('grantorOffice')
            ->add('relationshipMentioned')
            ->add('grantorRelationship')
            ->add('documentType')
            ->add('notaryName')
            ->add('protocolNumber')
            ->add('folioNumber')
            ->add('secondGrantor')
            ->add('secondGrantorName')
            ->add('filename')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TestaTraw::class,
        ]);
    }
}
