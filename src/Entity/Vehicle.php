<?php

namespace App\Entity;

use App\Enum\TypeOfVehicle;
use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehicleRepository::class)
 */
class Vehicle extends Entity
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $brand;

    /**
     * @ORM\Column(type="integer", enumType=TypeOfVehicle::class)
     */
    private ?TypeOfVehicle $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $yearOfManufacture;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $availableFrom;

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getType(): ?TypeOfVehicle
    {
        return $this->type;
    }

    public function setType(TypeOfVehicle $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getYearOfManufacture(): ?int
    {
        return $this->yearOfManufacture;
    }

    public function setYearOfManufacture(?int $yearOfManufacture): self
    {
        $this->yearOfManufacture = $yearOfManufacture;

        return $this;
    }

    public function getAvailableFrom(): ?\DateTimeInterface
    {
        return $this->availableFrom;
    }

    public function setAvailableFrom(?\DateTimeInterface $availableFrom): self
    {
        $this->availableFrom = $availableFrom;

        return $this;
    }
}
