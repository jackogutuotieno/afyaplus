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
 * Entity class for "patient_visits" table
 */
#[Entity]
#[Table(name: "patient_visits")]
class PatientVisit extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "visit_type_id", type: "integer")]
    private int $visitTypeId;

    #[Column(name: "payment_method_id", type: "integer")]
    private int $paymentMethodId;

    #[Column(name: "medical_scheme_id", type: "integer", nullable: true)]
    private ?int $medicalSchemeId;

    #[Column(name: "user_role", type: "string")]
    private string $userRole;

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

    public function getVisitTypeId(): int
    {
        return $this->visitTypeId;
    }

    public function setVisitTypeId(int $value): static
    {
        $this->visitTypeId = $value;
        return $this;
    }

    public function getPaymentMethodId(): int
    {
        return $this->paymentMethodId;
    }

    public function setPaymentMethodId(int $value): static
    {
        $this->paymentMethodId = $value;
        return $this;
    }

    public function getMedicalSchemeId(): ?int
    {
        return $this->medicalSchemeId;
    }

    public function setMedicalSchemeId(?int $value): static
    {
        $this->medicalSchemeId = $value;
        return $this;
    }

    public function getUserRole(): string
    {
        return HtmlDecode($this->userRole);
    }

    public function setUserRole(string $value): static
    {
        $this->userRole = RemoveXss($value);
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
