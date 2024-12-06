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
 * Entity class for "patients_radiology_reports" table
 */
#[Entity]
#[Table(name: "patients_radiology_reports")]
class PatientsRadiologyReport extends AbstractEntity
{
    #[Column(name: "radiology_requests_id", type: "integer")]
    private int $radiologyRequestsId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Id]
    #[Column(name: "visit_id", type: "integer")]
    #[GeneratedValue]
    private int $visitId;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(name: "patient_age", type: "bigint", nullable: true)]
    private ?string $patientAge;

    #[Column(type: "string")]
    private string $gender;

    #[Column(name: "service_name", type: "string")]
    private string $serviceName;

    #[Column(type: "string", nullable: true)]
    private ?string $radiologist;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    public function getRadiologyRequestsId(): int
    {
        return $this->radiologyRequestsId;
    }

    public function setRadiologyRequestsId(int $value): static
    {
        $this->radiologyRequestsId = $value;
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

    public function getPatientName(): ?string
    {
        return HtmlDecode($this->patientName);
    }

    public function setPatientName(?string $value): static
    {
        $this->patientName = RemoveXss($value);
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

    public function getGender(): string
    {
        return HtmlDecode($this->gender);
    }

    public function setGender(string $value): static
    {
        $this->gender = RemoveXss($value);
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

    public function getRadiologist(): ?string
    {
        return HtmlDecode($this->radiologist);
    }

    public function setRadiologist(?string $value): static
    {
        $this->radiologist = RemoveXss($value);
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
