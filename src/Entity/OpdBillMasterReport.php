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
 * Entity class for "opd_bill_master_report" table
 */
#[Entity]
#[Table(name: "opd_bill_master_report")]
class OpdBillMasterReport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $uhid;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(type: "bigint", nullable: true)]
    private ?string $age;

    #[Column(type: "string")]
    private string $gender;

    #[Column(name: "visit_type", type: "string")]
    private string $visitType;

    #[Column(name: "payment_method", type: "string")]
    private string $paymentMethod;

    #[Column(type: "string")]
    private string $company;

    #[Column(name: "visit_date", type: "datetime")]
    private DateTime $visitDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getUhid(): int
    {
        return $this->uhid;
    }

    public function setUhid(int $value): static
    {
        $this->uhid = $value;
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

    public function getVisitType(): string
    {
        return HtmlDecode($this->visitType);
    }

    public function setVisitType(string $value): static
    {
        $this->visitType = RemoveXss($value);
        return $this;
    }

    public function getPaymentMethod(): string
    {
        return HtmlDecode($this->paymentMethod);
    }

    public function setPaymentMethod(string $value): static
    {
        $this->paymentMethod = RemoveXss($value);
        return $this;
    }

    public function getCompany(): string
    {
        return HtmlDecode($this->company);
    }

    public function setCompany(string $value): static
    {
        $this->company = RemoveXss($value);
        return $this;
    }

    public function getVisitDate(): DateTime
    {
        return $this->visitDate;
    }

    public function setVisitDate(DateTime $value): static
    {
        $this->visitDate = $value;
        return $this;
    }
}
