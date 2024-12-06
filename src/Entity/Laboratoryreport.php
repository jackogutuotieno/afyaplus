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
 * Entity class for "laboratory_reports" table
 */
#[Entity]
#[Table(name: "laboratory_reports")]
class LaboratoryReport extends AbstractEntity
{
    #[Column(type: "integer")]
    private int $id;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(type: "string")]
    private string $gender;

    #[Column(name: "patient_age", type: "bigint", nullable: true)]
    private ?string $patientAge;

    #[Column(type: "text", nullable: true)]
    private ?string $tests;

    #[Column(name: "disease_name", type: "string", nullable: true)]
    private ?string $diseaseName;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "report_month", type: "string", nullable: true)]
    private ?string $reportMonth;

    public function __construct()
    {
        $this->id = 0;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
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

    public function getGender(): string
    {
        return HtmlDecode($this->gender);
    }

    public function setGender(string $value): static
    {
        $this->gender = RemoveXss($value);
        return $this;
    }

    public function getPatientAge(): ?string
    {
        return $this->patientAge;
    }

    public function setPatientAge(?string $value): static
    {
        $this->patientAge = $value;
        return $this;
    }

    public function getTests(): ?string
    {
        return HtmlDecode($this->tests);
    }

    public function setTests(?string $value): static
    {
        $this->tests = RemoveXss($value);
        return $this;
    }

    public function getDiseaseName(): ?string
    {
        return HtmlDecode($this->diseaseName);
    }

    public function setDiseaseName(?string $value): static
    {
        $this->diseaseName = RemoveXss($value);
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

    public function getReportMonth(): ?string
    {
        return HtmlDecode($this->reportMonth);
    }

    public function setReportMonth(?string $value): static
    {
        $this->reportMonth = RemoveXss($value);
        return $this;
    }
}
