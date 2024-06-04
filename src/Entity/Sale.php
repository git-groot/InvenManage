<?php

namespace App\Entity;

use App\Repository\SaleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaleRepository::class)]
class Sale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?RefCompany $Company = null;
    private $companyId;

    #[ORM\ManyToOne]
    private ?Customer $customer = null;
    private $customerId;

    // #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    // private ?\DateTimeInterface $Date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $BeforeTax = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TotalTax = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TotalAmount = null;

    private $StartDates;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DateTime = null;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?RefCompany
    {
        return $this->Company;
    }

    public function setCompany(?RefCompany $Company): static
    {
        $this->Company = $Company;

        return $this;
    }
    public function getcompanyId(): ?string
    {
        return $this->companyId;
    }

    public function setcompanyId(?string $companyId): static
    {
        $this->companyId = $companyId;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }
    public function getcustomerId(): ?string
    {
        return $this->customerId;
    }

    public function setcustomerId(?string $customerId): static
    {
        $this->customerId = $customerId;

        return $this;
    }

    // public function getDate(): ?\DateTimeInterface
    // {
    //     return $this->Date;
    // }

    // public function setDate(?\DateTimeInterface $Date): static
    // {
    //     $this->Date = $Date;

    //     return $this;
    // }

    public function getStartDates(): ?string
    {
        return $this->StartDates;
    }

    public function setStartDates(?string $StartDates): static
    {
        $this->StartDates = $StartDates;

        return $this;
    }
    
    public function getBeforeTax(): ?string
    {
        return $this->BeforeTax;
    }

    public function setBeforeTax(?string $BeforeTax): static
    {
        $this->BeforeTax = $BeforeTax;

        return $this;
    }

    public function getTotalTax(): ?string
    {
        return $this->TotalTax;
    }

    public function setTotalTax(?string $TotalTax): static
    {
        $this->TotalTax = $TotalTax;

        return $this;
    }

    public function getTotalAmount(): ?string
    {
        return $this->TotalAmount;
    }

    public function setTotalAmount(?string $TotalAmount): static
    {
        $this->TotalAmount = $TotalAmount;

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->DateTime;
    }

    public function setDateTime(?\DateTimeInterface $DateTime): static
    {
        $this->DateTime = $DateTime;

        return $this;
    }

   
}
