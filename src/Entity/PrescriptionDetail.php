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
 * Entity class for "prescription_details" table
 */
#[Entity]
#[Table(name: "prescription_details")]
class PrescriptionDetail extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "prescription_id", type: "integer")]
    private int $prescriptionId;

    #[Column(name: "medicine_stock_id", type: "integer")]
    private int $medicineStockId;

    #[Column(type: "string")]
    private string $method;

    #[Column(name: "dose_quantity", type: "integer")]
    private int $doseQuantity;

    #[Column(name: "dose_type", type: "string")]
    private string $doseType;

    #[Column(type: "string")]
    private string $formulation;

    #[Column(name: "dose_interval", type: "string")]
    private string $doseInterval;

    #[Column(name: "number_of_days", type: "integer")]
    private int $numberOfDays;

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

    public function getPrescriptionId(): int
    {
        return $this->prescriptionId;
    }

    public function setPrescriptionId(int $value): static
    {
        $this->prescriptionId = $value;
        return $this;
    }

    public function getMedicineStockId(): int
    {
        return $this->medicineStockId;
    }

    public function setMedicineStockId(int $value): static
    {
        $this->medicineStockId = $value;
        return $this;
    }

    public function getMethod(): string
    {
        return HtmlDecode($this->method);
    }

    public function setMethod(string $value): static
    {
        $this->method = RemoveXss($value);
        return $this;
    }

    public function getDoseQuantity(): int
    {
        return $this->doseQuantity;
    }

    public function setDoseQuantity(int $value): static
    {
        $this->doseQuantity = $value;
        return $this;
    }

    public function getDoseType(): string
    {
        return HtmlDecode($this->doseType);
    }

    public function setDoseType(string $value): static
    {
        $this->doseType = RemoveXss($value);
        return $this;
    }

    public function getFormulation(): string
    {
        return HtmlDecode($this->formulation);
    }

    public function setFormulation(string $value): static
    {
        $this->formulation = RemoveXss($value);
        return $this;
    }

    public function getDoseInterval(): string
    {
        return HtmlDecode($this->doseInterval);
    }

    public function setDoseInterval(string $value): static
    {
        $this->doseInterval = RemoveXss($value);
        return $this;
    }

    public function getNumberOfDays(): int
    {
        return $this->numberOfDays;
    }

    public function setNumberOfDays(int $value): static
    {
        $this->numberOfDays = $value;
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
