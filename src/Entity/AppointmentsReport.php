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
 * Entity class for "appointments_report" table
 */
#[Entity]
#[Table(name: "appointments_report")]
class AppointmentsReport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(type: "string")]
    private string $title;

    #[Column(name: "start_date", type: "date")]
    private DateTime $startDate;

    #[Column(name: "end_date", type: "date")]
    private DateTime $endDate;

    #[Column(name: "start_time", type: "time", nullable: true)]
    private ?DateTime $startTime;

    #[Column(name: "end_time", type: "time", nullable: true)]
    private ?DateTime $endTime;

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

    #[Column(name: "doctor_name", type: "string", nullable: true)]
    private ?string $doctorName;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getTitle(): string
    {
        return HtmlDecode($this->title);
    }

    public function setTitle(string $value): static
    {
        $this->title = RemoveXss($value);
        return $this;
    }

    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(DateTime $value): static
    {
        $this->startDate = $value;
        return $this;
    }

    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(DateTime $value): static
    {
        $this->endDate = $value;
        return $this;
    }

    public function getStartTime(): ?DateTime
    {
        return $this->startTime;
    }

    public function setStartTime(?DateTime $value): static
    {
        $this->startTime = $value;
        return $this;
    }

    public function getEndTime(): ?DateTime
    {
        return $this->endTime;
    }

    public function setEndTime(?DateTime $value): static
    {
        $this->endTime = $value;
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

    public function getDoctorName(): ?string
    {
        return HtmlDecode($this->doctorName);
    }

    public function setDoctorName(?string $value): static
    {
        $this->doctorName = RemoveXss($value);
        return $this;
    }
}
