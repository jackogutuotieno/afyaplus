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
 * Entity class for "ipd_billing_report" table
 */
#[Entity]
#[Table(name: "ipd_billing_report")]
class IpdBillingReport extends AbstractEntity
{
    #[Id]
    #[Column(name: "patient_uhid", type: "integer")]
    #[GeneratedValue]
    private int $patientUhid;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(type: "bigint", nullable: true)]
    private ?string $age;

    #[Column(type: "string")]
    private string $gender;

    #[Column(name: "date_admitted", type: "datetime")]
    private DateTime $dateAdmitted;

    #[Column(name: "date_discharged", type: "datetime")]
    private DateTime $dateDischarged;

    public function getPatientUhid(): int
    {
        return $this->patientUhid;
    }

    public function setPatientUhid(int $value): static
    {
        $this->patientUhid = $value;
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

    public function getDateAdmitted(): DateTime
    {
        return $this->dateAdmitted;
    }

    public function setDateAdmitted(DateTime $value): static
    {
        $this->dateAdmitted = $value;
        return $this;
    }

    public function getDateDischarged(): DateTime
    {
        return $this->dateDischarged;
    }

    public function setDateDischarged(DateTime $value): static
    {
        $this->dateDischarged = $value;
        return $this;
    }
}
