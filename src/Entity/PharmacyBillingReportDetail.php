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
 * Entity class for "pharmacy_billing_report_details" table
 */
#[Entity]
#[Table(name: "pharmacy_billing_report_details")]
class PharmacyBillingReportDetail extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "medicine_dispensation_id", type: "integer")]
    private int $medicineDispensationId;

    #[Column(name: "brand_name", type: "string")]
    private string $brandName;

    #[Column(name: "selling_price_per_unit", type: "float")]
    private float $sellingPricePerUnit;

    #[Column(type: "integer")]
    private int $quantity;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getMedicineDispensationId(): int
    {
        return $this->medicineDispensationId;
    }

    public function setMedicineDispensationId(int $value): static
    {
        $this->medicineDispensationId = $value;
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

    public function getSellingPricePerUnit(): float
    {
        return $this->sellingPricePerUnit;
    }

    public function setSellingPricePerUnit(float $value): static
    {
        $this->sellingPricePerUnit = $value;
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
}
