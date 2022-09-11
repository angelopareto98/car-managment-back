<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CarRepository::class)]
#[ApiResource(
    iri: 'https://schema.org/Car',
    normalizationContext: ['groups' => ['car:read']],
    denormalizationContext: ['groups' => ['car:write']],
    collectionOperations: [
        'GET',
        'POST' => [
            'input_formats' => [
                'multipart' => 'multipart/form-data'
            ],
        ],
    ],
)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['car:read'])]
    private ?string $numberCar = null;

    #[ORM\Column(length: 100)]
    #[Groups(['car:read', 'car:write'])]
    private ?string $mark = null;

    #[ORM\Column]
    #[Groups(['car:read', 'car:write'])]
    private ?float $priceUnit = null;

    #[ORM\Column]
    #[Groups(['car:read', 'car:write'])]
    private ?int $stock = null;

    #[ApiProperty(iri: 'https://schema.org/contentUrl')]
    #[Groups(['car:read'])]
    public ?string $contentUrl = null;

    /**
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
    */
    #[Groups(['car:write'])]
    public ?File $file = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filePath = null;

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

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }
}
