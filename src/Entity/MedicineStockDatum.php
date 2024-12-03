<?php

namespace PHPMaker2024\afyaplus\Entity;

use DateTime;
use DateTimeImmutable;
use DateInterval;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\SequenceGenerator;
use Doctrine\DBAL\Types\Types;
use PHPMaker2024\afyaplus\AbstractEntity;
use PHPMaker2024\afyaplus\AdvancedSecurity;
use PHPMaker2024\afyaplus\UserProfile;
use function PHPMaker2024\afyaplus\Config;
use function PHPMaker2024\afyaplus\EntityManager;
use function PHPMaker2024\afyaplus\RemoveXss;
use function PHPMaker2024\afyaplus\HtmlDecode;
use function PHPMaker2024\afyaplus\EncryptPassword;

/**
 * Entity class for "medicine_stock_data" table
 */
#[Entity]
#[Table(name: "medicine_stock_data")]
class MedicineStockDatum extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(type: "integer")]
    private int $quantity;

    #[Column(name: "measuring_unit", type: "string")]
    private string $measuringUnit;

    #[Column(name: "buying_price_per_unit", type: "float")]
    private float $buyingPricePerUnit;

    #[Column(name: "selling_price_per_unit", type: "float")]
    private float $sellingPricePerUnit;

    #[Column(name: "expiry_date", type: "date")]
    private DateTime $expiryDate;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "supplier_name", type: "string")]
    private string $supplierName;

    #[Column(type: "string")]
    private string $phone;

    #[Column(name: "email_address", type: "string")]
    private string $emailAddress;

    #[Column(name: "physical_address", type: "text", nullable: true)]
    private ?string $physicalAddress;

    #[Column(name: "brand_name", type: "string")]
    private string $brandName;

    #[Column(name: "batch_number", type: "string")]
    private string $batchNumber;

    #[Column(name: "stockadd_month", type: "string", nullable: true)]
    private ?string $stockaddMonth;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $value): static
    {
        $this->quantity = $value;
        return $this;
    }

    public function getMeasuringUnit(): string
    {
        return HtmlDecode($this->measuringUnit);
    }

    public function setMeasuringUnit(string $value): static
    {
        $this->measuringUnit = RemoveXss($value);
        return $this;
    }

    public function getBuyingPricePerUnit(): float
    {
        return $this->buyingPricePerUnit;
    }

    public function setBuyingPricePerUnit(float $value): static
    {
        $this->buyingPricePerUnit = $value;
        return $this;
    }

    public function getSellingPricePerUnit(): float
    {
        return $this->sellingPricePerUnit;
    }

    public function setSellingPricePerUnit(float $value): static
    {
        $this->sellingPricePerUnit = $value;
        return $this;
    }

    public function getExpiryDate(): DateTime
    {
        return $this->expiryDate;
    }

    public function setExpiryDate(DateTime $value): static
    {
        $this->expiryDate = $value;
        return $this;
    }

    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(DateTime $value): static
    {
        $this->dateCreated = $value;
        return $this;
    }

    public function getDateUpdated(): DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(DateTime $value): static
    {
        $this->dateUpdated = $value;
        return $this;
    }

    public function getSupplierName(): string
    {
        return HtmlDecode($this->supplierName);
    }

    public function setSupplierName(string $value): static
    {
        $this->supplierName = RemoveXss($value);
        return $this;
    }

    public function getPhone(): string
    {
        return HtmlDecode($this->phone);
    }

    public function setPhone(string $value): static
    {
        $this->phone = RemoveXss($value);
        return $this;
    }

    public function getEmailAddress(): string
    {
        return HtmlDecode($this->emailAddress);
    }

    public function setEmailAddress(string $value): static
    {
        $this->emailAddress = RemoveXss($value);
        return $this;
    }

    public function getPhysicalAddress(): ?string
    {
        return HtmlDecode($this->physicalAddress);
    }

    public function setPhysicalAddress(?string $value): static
    {
        $this->physicalAddress = RemoveXss($value);
        return $this;
    }

    public function getBrandName(): string
    {
        return HtmlDecode($this->brandName);
    }

    public function setBrandName(string $value): static
    {
        $this->brandName = RemoveXss($value);
        return $this;
    }

    public function getBatchNumber(): string
    {
        return HtmlDecode($this->batchNumber);
    }

    public function setBatchNumber(string $value): static
    {
        $this->batchNumber = RemoveXss($value);
        return $this;
    }

    public function getStockaddMonth(): ?string
    {
        return HtmlDecode($this->stockaddMonth);
    }

    public function setStockaddMonth(?string $value): static
    {
        $this->stockaddMonth = RemoveXss($value);
        return $this;
    }
}
