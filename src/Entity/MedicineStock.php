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
 * Entity class for "medicine_stock" table
 */
#[Entity]
#[Table(name: "medicine_stock")]
class MedicineStock extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "supplier_id", type: "integer")]
    private int $supplierId;

    #[Column(name: "brand_id", type: "integer")]
    private int $brandId;

    #[Column(name: "batch_number", type: "string")]
    private string $batchNumber;

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

    #[Column(name: "invoice_attachment", type: "blob")]
    private mixed $invoiceAttachment;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getSupplierId(): int
    {
        return $this->supplierId;
    }

    public function setSupplierId(int $value): static
    {
        $this->supplierId = $value;
        return $this;
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }

    public function setBrandId(int $value): static
    {
        $this->brandId = $value;
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

    public function getInvoiceAttachment(): mixed
    {
        return $this->invoiceAttachment;
    }

    public function setInvoiceAttachment(mixed $value): static
    {
        $this->invoiceAttachment = $value;
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
}
