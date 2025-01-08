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
 * Entity class for "procurement_report" table
 */
#[Entity]
#[Table(name: "procurement_report")]
class ProcurementReport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "batch_number", type: "string")]
    private string $batchNumber;

    #[Column(name: "supplier_name", type: "string")]
    private string $supplierName;

    #[Column(name: "category_name", type: "string")]
    private string $categoryName;

    #[Column(name: "subcategory_name", type: "string")]
    private string $subcategoryName;

    #[Column(name: "item_title", type: "string")]
    private string $itemTitle;

    #[Column(type: "integer")]
    private int $quantity;

    #[Column(name: "measuring_unit", type: "string")]
    private string $measuringUnit;

    #[Column(name: "unit_price", type: "float")]
    private float $unitPrice;

    #[Column(name: "selling_price", type: "float")]
    private float $sellingPrice;

    #[Column(name: "amount_paid", type: "float")]
    private float $amountPaid;

    #[Column(name: "purchase_month", type: "string", nullable: true)]
    private ?string $purchaseMonth;

    #[Column(name: "purchase_year", type: "integer", nullable: true)]
    private ?int $purchaseYear;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
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

    public function getSupplierName(): string
    {
        return HtmlDecode($this->supplierName);
    }

    public function setSupplierName(string $value): static
    {
        $this->supplierName = RemoveXss($value);
        return $this;
    }

    public function getCategoryName(): string
    {
        return HtmlDecode($this->categoryName);
    }

    public function setCategoryName(string $value): static
    {
        $this->categoryName = RemoveXss($value);
        return $this;
    }

    public function getSubcategoryName(): string
    {
        return HtmlDecode($this->subcategoryName);
    }

    public function setSubcategoryName(string $value): static
    {
        $this->subcategoryName = RemoveXss($value);
        return $this;
    }

    public function getItemTitle(): string
    {
        return HtmlDecode($this->itemTitle);
    }

    public function setItemTitle(string $value): static
    {
        $this->itemTitle = RemoveXss($value);
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

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $value): static
    {
        $this->unitPrice = $value;
        return $this;
    }

    public function getSellingPrice(): float
    {
        return $this->sellingPrice;
    }

    public function setSellingPrice(float $value): static
    {
        $this->sellingPrice = $value;
        return $this;
    }

    public function getAmountPaid(): float
    {
        return $this->amountPaid;
    }

    public function setAmountPaid(float $value): static
    {
        $this->amountPaid = $value;
        return $this;
    }

    public function getPurchaseMonth(): ?string
    {
        return HtmlDecode($this->purchaseMonth);
    }

    public function setPurchaseMonth(?string $value): static
    {
        $this->purchaseMonth = RemoveXss($value);
        return $this;
    }

    public function getPurchaseYear(): ?int
    {
        return $this->purchaseYear;
    }

    public function setPurchaseYear(?int $value): static
    {
        $this->purchaseYear = $value;
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
}
