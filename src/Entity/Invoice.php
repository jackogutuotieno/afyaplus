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
 * Entity class for "invoices" table
 */
#[Entity]
#[Table(name: "invoices")]
class Invoice extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "visit_id", type: "integer")]
    private int $visitId;

    #[Column(name: "invoice_title", type: "string")]
    private string $invoiceTitle;

    #[Column(type: "text", nullable: true)]
    private ?string $description;

    #[Column(name: "payment_status", type: "string")]
    private string $paymentStatus;

    #[Column(name: "created_by_user_id", type: "integer")]
    private int $createdByUserId;

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

    public function getVisitId(): int
    {
        return $this->visitId;
    }

    public function setVisitId(int $value): static
    {
        $this->visitId = $value;
        return $this;
    }

    public function getInvoiceTitle(): string
    {
        return HtmlDecode($this->invoiceTitle);
    }

    public function setInvoiceTitle(string $value): static
    {
        $this->invoiceTitle = RemoveXss($value);
        return $this;
    }

    public function getDescription(): ?string
    {
        return HtmlDecode($this->description);
    }

    public function setDescription(?string $value): static
    {
        $this->description = RemoveXss($value);
        return $this;
    }

    public function getPaymentStatus(): string
    {
        return HtmlDecode($this->paymentStatus);
    }

    public function setPaymentStatus(string $value): static
    {
        $this->paymentStatus = RemoveXss($value);
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
