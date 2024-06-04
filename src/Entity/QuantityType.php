<?php

namespace App\Entity;

use App\Repository\QuantityTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuantityTypeRepository::class)]
class QuantityType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quanName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $MesaarMent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Units = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Price = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quanStatus = null;

    #[ORM\ManyToOne]
    private ?products $product = null;
    private $productId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->quanName;
    }

    public function setName(?string $quanName): static
    {
        $this->quanName = $quanName;

        return $this;
    }

    public function getMesaarMent(): ?string
    {
        return $this->MesaarMent;
    }

    public function setMesaarMent(?string $MesaarMent): static
    {
        $this->MesaarMent = $MesaarMent;

        return $this;
    }

    public function getUnits(): ?string
    {
        return $this->Units;
    }

    public function setUnits(?string $Units): static
    {
        $this->Units = $Units;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->Price;
    }

    public function setPrice(?string $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->quanStatus;
    }

    public function setStatus(?string $quanStatus): static
    {
        $this->quanStatus = $quanStatus;

        return $this;
    }

    public function getProduct(): ?products
    {
        return $this->product;
    }

    public function setProduct(?products $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(?string $productId): static
    {
        $this->productId = $productId;

        return $this;
    }
}
