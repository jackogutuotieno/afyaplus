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
 * Entity class for "item_purchases" table
 */
#[Entity]
#[Table(name: "item_purchases")]
class ItemPurchase extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "supplier_id", type: "integer")]
    private int $supplierId;

    #[Column(name: "category_id", type: "integer")]
    private int $categoryId;

    #[Column(name: "subcategory_id", type: "integer")]
    private int $subcategoryId;

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

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $value): static
    {
        $this->categoryId = $value;
        return $this;
    }

    public function getSubcategoryId(): int
    {
        return $this->subcategoryId;
    }

    public function setSubcategoryId(int $value): static
    {
        $this->subcategoryId = $value;
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
