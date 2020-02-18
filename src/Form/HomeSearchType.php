<?php

namespace App\Form;

use App\Repository\EmplacementRepository;
use Symfony\Component\Form\{
    AbstractType,
    FormBuilderInterface,
    Extension\Core\Type\ChoiceType,
    Extension\Core\Type\SubmitType,
    Extension\Core\Type\TextType
};
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\Data\HomeSearchData;

class HomeSearchType extends AbstractType
{
    /** @var EmplacementRepository */
    protected $emplacementRepository;

    public function __construct(EmplacementRepository $emplacementRepository)
    {
        $this->emplacementRepository = $emplacementRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', TextType::class, [
                'attr' => [
                    'class' => 'datepicker'
                ]
            ])
            ->add('endDate', TextType::class, [
                'attr' => [
                    'class' => 'datepicker'
                ]
            ])
            ->add('location', TextType::class)
            ->add('name', TextType::class)
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Please choose an option' => '',
                    'Reserved' => 'reserved',
                    'Currently' => 'currently',
                    'Canceled' => 'canceled'
                ]
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HomeSearchData::class
        ]);
    }
}
