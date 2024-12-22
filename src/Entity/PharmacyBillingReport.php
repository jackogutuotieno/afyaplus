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
 * Entity class for "pharmacy_billing_report" table
 */
#[Entity]
#[Table(name: "pharmacy_billing_report")]
class PharmacyBillingReport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "prescription_id", type: "integer", nullable: true)]
    private ?int $prescriptionId;

    #[Column(name: "dispensation_type", type: "string")]
    private string $dispensationType;

    #[Column(name: "created_by_user_id", type: "integer")]
    private int $createdByUserId;

    #[Column(type: "string")]
    private string $status;

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

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function setPatientId(int $value): static
    {
        $this->patientId = $value;
        return $this;
    }

    public function getPrescriptionId(): ?int
    {
        return $this->prescriptionId;
    }

    public function setPrescriptionId(?int $value): static
    {
        $this->prescriptionId = $value;
        return $this;
    }

    public function getDispensationType(): string
    {
        return HtmlDecode($this->dispensationType);
    }

    public function setDispensationType(string $value): static
    {
        $this->dispensationType = RemoveXss($value);
        return $this;
    }

    public function getCreatedByUserId(): int
    {
        return $this->createdByUserId;
    }

    public function setCreatedByUserId(int $value): static
    {
        $this->createdByUserId = $value;
        return $this;
    }

    public function getStatus(): string
    {
        return HtmlDecode($this->status);
    }

    public function setStatus(string $value): static
    {
        $this->status = RemoveXss($value);
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
