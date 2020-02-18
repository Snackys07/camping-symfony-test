<?php

namespace App\Form;

use App\Entity\Sejour;
use Symfony\Component\Form\{
    AbstractType,
    Extension\Core\Type\SubmitType,
    Extension\Core\Type\TextType,
    FormBuilderInterface
};
use Symfony\Component\OptionsResolver\OptionsResolver;

class GetSejourByDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_date', TextType::class, [
                'attr' => [
                    'class' => 'datepicker'
                ]
            ])
            ->add('end_date', TextType::class, [
                'attr' => [
                    'class' => 'datepicker'
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
