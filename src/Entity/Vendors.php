<?php

namespace App\Entity;

use App\Repository\VendorsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VendorsRepository::class)]
class Vendors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $State = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $PinCode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $GSTno = null;

    #[ORM\ManyToOne]
    private ?RefCompany $Company = null;
    private $companyId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(?string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(?string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(?string $Phone): static
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(?string $Address): static
    {
        $this->Address = $Address;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->State;
    }

    public function setState(?string $State): static
    {
        $this->State = $State;

        return $this;
    }

    public function getPinCode(): ?string
    {
        return $this->PinCode;
    }

    public function setPinCode(?string $PinCode): static
    {
        $this->PinCode = $PinCode;

        return $this;
    }

    public function getGSTno(): ?string
    {
        return $this->GSTno;
    }

    public function setGSTno(?string $GSTno): static
    {
        $this->GSTno = $GSTno;

        return $this;
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
    public function getCompanyId(): ?string
    {
        return $this->companyId;
    }
    public function setCompanyId(?string $companyId): static
    {
        $this->companyId = $companyId;
        return $this;
    }
}
