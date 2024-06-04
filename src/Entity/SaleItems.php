<?php

namespace App\Entity;

use App\Repository\SaleItemsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaleItemsRepository::class)]
class SaleItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Products $product = null;
    private $productid;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Quantitys = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $hsncode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $unitPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Cgst = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Sgst = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TotalPrice = null;

    #[ORM\ManyToOne]
    private ?Sale $sale = null;
    private $saleId;

    #[ORM\ManyToOne]
    private ?Inventory $Inventory = null;
    private $inventoryId;

    private $vrray;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $BuyingPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $Profit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customerphoneno = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    private $startdates;
    private $enddates;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Products
    {
        return $this->product;
    }

    public function setProduct(?Products $product): static
    {
        $this->product = $product;

        return $this;
    }
    public function getProductId(): ?array
    {
        return $this->productid;
    }

    public function setProductId(?array $productid): static
    {
        $this->productid = $productid;

        return $this;
    }

    public function getQuantitys(): ?string
    {
        return $this->Quantitys;
    }

    public function setQuantitys(?string $Quantitys): static
    {
        $this->Quantitys = $Quantitys;

        return $this;
    }

    public function getHsncode(): ?string
    {
        return $this->hsncode;
    }

    public function setHsncode(?string $hsncode): static
    {
        $this->hsncode = $hsncode;

        return $this;
    }

    public function getUnitPrice(): ?string
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(?string $unitPrice): static
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getCgst(): ?string
    {
        return $this->Cgst;
    }

    public function setCgst(?string $Cgst): static
    {
        $this->Cgst = $Cgst;

        return $this;
    }

    public function getSgst(): ?string
    {
        return $this->Sgst;
    }

    public function setSgst(?string $Sgst): static
    {
        $this->Sgst = $Sgst;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->TotalPrice;
    }

    public function setTotalPrice(?string $TotalPrice): static
    {
        $this->TotalPrice = $TotalPrice;

        return $this;
    }

    public function getVrray(): ?array
    {
        return $this->vrray;
    }

    public function setVrray(?array $vrray): static
    {
        $this->vrray = $vrray;

        return $this;
    }

    public function getSaleitem(): ?Sale
    {
        return $this->sale;
    }

    public function setSaleitem(?Sale $sale): static
    {
        $this->sale = $sale;

        return $this;
    }
    public function getSaleId(): ?string
    {
        return $this->saleId;
    }

    public function setSaleId(?string $saleId): static
    {
        $this->saleId = $saleId;

        return $this;
    }

    public function getInventory(): ?Inventory
    {
        return $this->Inventory;
    }

    public function setInventory(?Inventory $Inventory): static
    {
        $this->Inventory = $Inventory;

        return $this;
    }
    public function getInventoryId(): ?string
    {
        return $this->inventoryId;
    }

    public function setInventoryId(?string $inventoryId): static
    {
        $this->inventoryId = $inventoryId;

        return $this;
    }

    public function getBuyingPrice(): ?string
    {
        return $this->BuyingPrice;
    }

    public function setBuyingPrice(?string $BuyingPrice): static
    {
        $this->BuyingPrice = $BuyingPrice;

        return $this;
    }

    public function getProfit(): ?int
    {
        return $this->Profit;
    }

    public function setProfit(?int $Profit): static
    {
        $this->Profit = $Profit;

        return $this;
    }

    public function getCustomerphoneno(): ?string
    {
        return $this->customerphoneno;
    }

    public function setCustomerphoneno(?string $customerphoneno): static
    {
        $this->customerphoneno = $customerphoneno;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
    public function getstartDatees(): ?string
    {
        return $this->startdates;
    }

    public function setstartDatees(?string $startdates): static
    {
        $this->startdates = $startdates;

        return $this;
    }

    public function getEndDatees(): ?string
    {
        return $this->enddates;
    }

    public function setEndDatees(?string $enddates): static
    {
        $this->enddates = $enddates;

        return $this;
    }
}
