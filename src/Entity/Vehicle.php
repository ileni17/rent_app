<?php

namespace App\Entity;

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
    private $brand;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $yearOfManufacture;

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getYearOfManufacture(): ?\DateTimeInterface
    {
        return $this->yearOfManufacture;
    }

    public function setYearOfManufacture(?\DateTimeInterface $yearOfManufacture): self
    {
        $this->yearOfManufacture = $yearOfManufacture;

        return $this;
    }
}
