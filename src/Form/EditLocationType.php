<?php

namespace App\Form;

use App\Entity\Emplacement;
use Symfony\Component\Form\{
    AbstractType,
    Extension\Core\Type\IntegerType,
    Extension\Core\Type\SubmitType,
    Extension\Core\Type\TextType,
    FormBuilderInterface
};
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditLocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('capacity', IntegerType::class)
            ->add('superficie', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emplacement::class,
        ]);
    }
}
