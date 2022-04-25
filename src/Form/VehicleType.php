<?php

namespace App\Form;

use App\Entity\Vehicle;
use App\Enum\TypeOfVehicle;
use App\Service\YearSpanGenerator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Service\Attribute\Required;

class VehicleType extends AbstractType
{
    #[Required]
    public YearSpanGenerator $yearSpanGenerator;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $years = $this->yearSpanGenerator->getYears('1990');

        $builder
            ->add('brand')
            ->add('type', EnumType::class, [
                'class' => TypeOfVehicle::class,
            ])
            ->add('yearOfManufacture', ChoiceType::class, [
                'choices' => $years,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
