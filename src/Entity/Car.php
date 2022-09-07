<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ApiResource]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $numberCar = null;

    #[ORM\Column(length: 100)]
    private ?string $mark = null;

    #[ORM\Column]
    private ?float $priceUnit = null;

    #[ORM\Column]
    private ?int $stock = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberCar(): ?string
    {
        return $this->numberCar;
    }

    public function setNumberCar(string $numberCar): self
    {
        $this->numberCar = $numberCar;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getPriceUnit(): ?float
    {
        return $this->priceUnit;
    }

    public function setPriceUnit(float $priceUnit): self
    {
        $this->priceUnit = $priceUnit;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }
}
