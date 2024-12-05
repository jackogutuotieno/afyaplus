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
 * Entity class for "patients_lab_report" table
 */
#[Entity]
#[Table(name: "patients_lab_report")]
class PatientsLabReport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Id]
    #[Column(name: "visit_id", type: "integer")]
    #[GeneratedValue]
    private int $visitId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(name: "date_of_birth", type: "date")]
    private DateTime $dateOfBirth;

    #[Column(type: "string")]
    private string $gender;

    #[Column(name: "patient_age", type: "bigint", nullable: true)]
    private ?string $patientAge;

    #[Column(type: "text", nullable: true)]
    private ?string $details;

    #[Column(type: "string", nullable: true)]
    private ?string $laboratorist;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    public function __construct(int $id, int $visitId)
    {
        $this->id = $id;
        $this->visitId = $visitId;
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

    public function getVisitId(): int
    {
        return $this->visitId;
    }

    public function setVisitId(int $value): static
    {
        $this->visitId = $value;
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

    public function getPatientAge(): ?string
    {
        return $this->patientAge;
    }

    public function setPatientAge(?string $value): static
    {
        $this->patientAge = $value;
        return $this;
    }

    public function getDetails(): ?string
    {
        return HtmlDecode($this->details);
    }

    public function setDetails(?string $value): static
    {
        $this->details = RemoveXss($value);
        return $this;
    }

    public function getLaboratorist(): ?string
    {
        return HtmlDecode($this->laboratorist);
    }

    public function setLaboratorist(?string $value): static
    {
        $this->laboratorist = RemoveXss($value);
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
