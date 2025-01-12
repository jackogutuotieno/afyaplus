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
 * Entity class for "doctor_notes" table
 */
#[Entity]
#[Table(name: "doctor_notes")]
class DoctorNote extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "visit_id", type: "integer")]
    private int $visitId;

    #[Column(name: "service_id", type: "integer")]
    private int $serviceId;

    #[Column(name: "chief_complaint", type: "text")]
    private string $chiefComplaint;

    #[Column(name: "history_of_presenting_illness", type: "text")]
    private string $historyOfPresentingIllness;

    #[Column(name: "past_medical_history", type: "text")]
    private string $pastMedicalHistory;

    #[Column(name: "family_history", type: "text")]
    private string $familyHistory;

    #[Column(type: "text")]
    private string $allergies;

    #[Column(name: "created_by_user_id", type: "integer")]
    private int $createdByUserId;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    public function __construct()
    {
        $this->serviceId = 1;
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

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $value): static
    {
        $this->serviceId = $value;
        return $this;
    }

    public function getChiefComplaint(): string
    {
        return HtmlDecode($this->chiefComplaint);
    }

    public function setChiefComplaint(string $value): static
    {
        $this->chiefComplaint = RemoveXss($value);
        return $this;
    }

    public function getHistoryOfPresentingIllness(): string
    {
        return HtmlDecode($this->historyOfPresentingIllness);
    }

    public function setHistoryOfPresentingIllness(string $value): static
    {
        $this->historyOfPresentingIllness = RemoveXss($value);
        return $this;
    }

    public function getPastMedicalHistory(): string
    {
        return HtmlDecode($this->pastMedicalHistory);
    }

    public function setPastMedicalHistory(string $value): static
    {
        $this->pastMedicalHistory = RemoveXss($value);
        return $this;
    }

    public function getFamilyHistory(): string
    {
        return HtmlDecode($this->familyHistory);
    }

    public function setFamilyHistory(string $value): static
    {
        $this->familyHistory = RemoveXss($value);
        return $this;
    }

    public function getAllergies(): string
    {
        return HtmlDecode($this->allergies);
    }

    public function setAllergies(string $value): static
    {
        $this->allergies = RemoveXss($value);
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
