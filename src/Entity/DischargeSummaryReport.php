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
 * Entity class for "discharge_summary_report" table
 */
#[Entity]
#[Table(name: "discharge_summary_report")]
class DischargeSummaryReport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(type: "bigint", nullable: true)]
    private ?string $age;

    #[Column(type: "string")]
    private string $gender;

    #[Column(name: "admission_reason", type: "text")]
    private string $admissionReason;

    #[Column(name: "discharge_condition", type: "text")]
    private string $dischargeCondition;

    #[Column(name: "created_by_user_id", type: "integer")]
    private int $createdByUserId;

    #[Column(name: "admission_date", type: "datetime")]
    private DateTime $admissionDate;

    #[Column(name: "discharge_date", type: "datetime")]
    private DateTime $dischargeDate;

    #[Column(name: "total_days", type: "integer", nullable: true)]
    private ?int $totalDays;

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

    public function getPatientName(): ?string
    {
        return HtmlDecode($this->patientName);
    }

    public function setPatientName(?string $value): static
    {
        $this->patientName = RemoveXss($value);
        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $value): static
    {
        $this->age = $value;
        return $this;
    }

    public function getGender(): string
    {
        return HtmlDecode($this->gender);
    }

    public function setGender(string $value): static
    {
        $this->gender = RemoveXss($value);
        return $this;
    }

    public function getAdmissionReason(): string
    {
        return HtmlDecode($this->admissionReason);
    }

    public function setAdmissionReason(string $value): static
    {
        $this->admissionReason = RemoveXss($value);
        return $this;
    }

    public function getDischargeCondition(): string
    {
        return HtmlDecode($this->dischargeCondition);
    }

    public function setDischargeCondition(string $value): static
    {
        $this->dischargeCondition = RemoveXss($value);
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

    public function getAdmissionDate(): DateTime
    {
        return $this->admissionDate;
    }

    public function setAdmissionDate(DateTime $value): static
    {
        $this->admissionDate = $value;
        return $this;
    }

    public function getDischargeDate(): DateTime
    {
        return $this->dischargeDate;
    }

    public function setDischargeDate(DateTime $value): static
    {
        $this->dischargeDate = $value;
        return $this;
    }

    public function getTotalDays(): ?int
    {
        return $this->totalDays;
    }

    public function setTotalDays(?int $value): static
    {
        $this->totalDays = $value;
        return $this;
    }
}
