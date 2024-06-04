<?php

namespace App\Entity;

use App\Repository\InventoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InventoryRepository::class)]
class Inventory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Quantity = null;

    #[ORM\Column(length: 255)]
    private ?string $BuyingPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $SellingPrice = null;

    #[ORM\ManyToOne]
    private ?Products $Product = null;
    private $productId;

    #[ORM\ManyToOne]
    private ?RefCompany $company = null;
    private $CompanyId;

    #[ORM\ManyToOne]
    private ?QuantityType $Quantitytype = null;
    private $quantitytypeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?string
    {
        return $this->Quantity;
    }

    public function setQuantity(?string $Quantity): static
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getBuyingPrice(): ?string
    {
        return $this->BuyingPrice;
    }

    public function setBuyingPrice(string $BuyingPrice): static
    {
        $this->BuyingPrice = $BuyingPrice;

        return $this;
    }

    public function getSellingPrice(): ?string
    {
        return $this->SellingPrice;
    }

    public function setSellingPrice(?string $SellingPrice): static
    {
        $this->SellingPrice = $SellingPrice;

        return $this;
    }

    public function getProduct(): ?Products
    {
        return $this->Product;
    }

    public function setProduct(?Products $Product): static
    {
        $this->Product = $Product;

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

    public function getCompany(): ?RefCompany
    {
        return $this->company;
    }

    public function setCompany(?RefCompany $company): static
    {
        $this->company = $company;

        return $this;
    }
    public function getCompanyId(): ?string
    {
        return $this->CompanyId;
    }

    public function setCompanyId(?string $CompanyId): static
    {
        $this->CompanyId = $CompanyId;

        return $this;
    }

    public function getQuantitytype(): ?QuantityType
    {
        return $this->Quantitytype;
    }

    public function setQuantitytype(?QuantityType $Quantitytype): static
    {
        $this->Quantitytype = $Quantitytype;

        return $this;
    }
    public function getQuantitytypeId(): ?string
    {
        return $this->quantitytypeId;
    }

    public function setQuantitytypeId(?string $quantitytypeId): static
    {
        $this->quantitytypeId = $quantitytypeId;

        return $this;
    }
}
