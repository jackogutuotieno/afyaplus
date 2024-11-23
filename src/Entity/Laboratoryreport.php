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
 * Entity class for "laboratoryreports" table
 */
#[Entity]
#[Table(name: "laboratoryreports")]
class Laboratoryreport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "report_title", type: "string")]
    private string $reportTitle;

    #[Column(type: "text")]
    private string $details;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(name: "date_of_birth", type: "date")]
    private DateTime $dateOfBirth;

    #[Column(type: "string")]
    private string $gender;

    #[Column(type: "string")]
    private string $specimen;

    #[Column(name: "service_name", type: "string")]
    private string $serviceName;

    #[Column(type: "float")]
    private float $cost;

    #[Column(type: "string")]
    private string $subcategory;

    #[Column(name: "additional_findings", type: "text", nullable: true)]
    private ?string $additionalFindings;

    #[Column(name: "disease_name", type: "string", nullable: true)]
    private ?string $diseaseName;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getReportTitle(): string
    {
        return HtmlDecode($this->reportTitle);
    }

    public function setReportTitle(string $value): static
    {
        $this->reportTitle = RemoveXss($value);
        return $this;
    }

    public function getDetails(): string
    {
        return HtmlDecode($this->details);
    }

    public function setDetails(string $value): static
    {
        $this->details = RemoveXss($value);
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

    public function getPatientName(): ?string
    {
        return HtmlDecode($this->patientName);
    }

    public function setPatientName(?string $value): static
    {
        $this->patientName = RemoveXss($value);
        return $this;
    }

    public function getDateOfBirth(): DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(DateTime $value): static
    {
        $this->dateOfBirth = $value;
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

    public function getSpecimen(): string
    {
        return HtmlDecode($this->specimen);
    }

    public function setSpecimen(string $value): static
    {
        $this->specimen = RemoveXss($value);
        return $this;
    }

    public function getServiceName(): string
    {
        return HtmlDecode($this->serviceName);
    }

    public function setServiceName(string $value): static
    {
        $this->serviceName = RemoveXss($value);
        return $this;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public function setCost(float $value): static
    {
        $this->cost = $value;
        return $this;
    }

    public function getSubcategory(): string
    {
        return HtmlDecode($this->subcategory);
    }

    public function setSubcategory(string $value): static
    {
        $this->subcategory = RemoveXss($value);
        return $this;
    }

    public function getAdditionalFindings(): ?string
    {
        return HtmlDecode($this->additionalFindings);
    }

    public function setAdditionalFindings(?string $value): static
    {
        $this->additionalFindings = RemoveXss($value);
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
}
