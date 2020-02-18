<?php

namespace App\Form;

use App\Entity\Sejour;
use Symfony\Component\Form\{
    AbstractType,
    Extension\Core\Type\ChoiceType,
    Extension\Core\Type\SubmitType,
    FormBuilderInterface
};
use Symfony\Component\OptionsResolver\OptionsResolver;

class GetSejourByStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Reserved' => 'reserved',
                    'Currently' => 'currently',
                    'Left' => 'left',
                    'Canceled' => 'canceled'

                ]
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sejour::class,
        ]);
    }
}
