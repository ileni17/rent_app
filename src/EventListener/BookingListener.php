<?php

namespace App\EventListener;

use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Contracts\Service\Attribute\Required;

class BookingListener
{
    #[Required]
    public EntityManagerInterface $entityManager;

    public function postPersist(Booking $booking, LifecycleEventArgs $event): void
    {
        $vehicle = $booking->getVehicle();

        if ($vehicle) {
            // set the return date for the booked vehicle
            $returnDate = $booking->getCreatedAt();
            $returnDate->modify('+' . $booking->getNumberOfDays() . 'day');

            $vehicle->setAvailableFrom($returnDate);
            $this->entityManager->persist($vehicle);
            $this->entityManager->flush();
        }
    }
}
