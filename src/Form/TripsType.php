<?php

namespace App\Form;

use App\Entity\Sejour;
use Symfony\Component\Form\{
    AbstractType,
    Extension\Core\Type\IntegerType,
    Extension\Core\Type\SubmitType,
    Extension\Core\Type\TextType,
    FormBuilderInterface
};
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripsType extends AbstractType
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
            ->add('customer_lastname', TextType::class)
            ->add('customer_firstname', TextType::class)
            ->add('customer_number', IntegerType::class)
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
