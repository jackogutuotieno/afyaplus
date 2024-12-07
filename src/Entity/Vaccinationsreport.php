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
 * Entity class for "vaccinations_report" table
 */
#[Entity]
#[Table(name: "vaccinations_report")]
class VaccinationsReport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(name: "patient_age", type: "bigint", nullable: true)]
    private ?string $patientAge;

    #[Column(type: "string")]
    private string $gender;

    #[Column(name: "service_name", type: "string")]
    private string $serviceName;

    #[Column(type: "string")]
    private string $status;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "vaccination_month", type: "string", nullable: true)]
    private ?string $vaccinationMonth;

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

    public function getVaccinationMonth(): ?string
    {
        return HtmlDecode($this->vaccinationMonth);
    }

    public function setVaccinationMonth(?string $value): static
    {
        $this->vaccinationMonth = RemoveXss($value);
        return $this;
    }
}
 HtmlDecode($this->categoryName);
    }

    public function setCategoryName(?string $value): static
    {
        $this->categoryName = RemoveXss($value);
        return $this;
    }

    public function getSubcategory(): ?string
    {
        return HtmlDecode($this->subcategory);
    }

    public function setSubcategory(?string $value): static
    {
        $this->subcategory = RemoveXss($value);
        return $this;
    }

    public function getNurse(): ?string
    {
        return HtmlDecode($this->nurse);
    }

    public function setNurse(?string $value): static
    {
        $this->nurse = RemoveXss($value);
        return $this;
    }
}
