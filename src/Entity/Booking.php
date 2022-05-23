<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking extends Entity
{
    /**
     * @ORM\ManyToOne(targetEntity=Vehicle::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicle;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfDays;

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    public function getNumberOfDays(): ?int
    {
        return $this->numberOfDays;
    }

    public function setNumberOfDays(int $numberOfDays): self
    {
        $this->numberOfDays = $numberOfDays;

        return $this;
    }
}
