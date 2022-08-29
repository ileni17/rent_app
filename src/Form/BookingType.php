<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Service\Attribute\Required;

class BookingType extends AbstractType
{
    #[Required]
    public EntityManagerInterface $entityManager;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $vehicles = $this->entityManager->getRepository(Vehicle::class)->getAvailableVehicles();

        $builder
            ->add('vehicle', EntityType::class, [
                'class' => Vehicle::class,
                'choices' => $vehicles,
            ])
            ->add('numberOfDays')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
