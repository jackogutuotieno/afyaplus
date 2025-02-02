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
 * Entity class for "moh704b_report" table
 */
#[Entity]
#[Table(name: "moh704b_report")]
class Moh704BReport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(name: "date_of_birth", type: "date")]
    private DateTime $dateOfBirth;

    #[Column(name: "patient_age", type: "bigint", nullable: true)]
    private ?string $patientAge;

    #[Column(type: "string")]
    private string $gender;

    #[Column(type: "string")]
    private string $phone;

    #[Column(name: "email_address", type: "string", nullable: true)]
    private ?string $emailAddress;

    #[Column(type: "string")]
    private string $countyName;

    #[Column(type: "string", nullable: true)]
    private ?string $subCounty;

    #[Column(name: "marital_status", type: "string", nullable: true)]
    private ?string $maritalStatus;

    #[Column(name: "next_of_kin", type: "string")]
    private string $nextOfKin;

    #[Column(name: "next_of_kin_phone", type: "string")]
    private string $nextOfKinPhone;

    #[Column(name: "registration_month", type: "string", nullable: true)]
    private ?string $registrationMonth;

    #[Column(name: "registrration_date", type: "datetime")]
    private DateTime $registrrationDate;

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

    public function getDateOfBirth(): DateTime
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(DateTime $value): static
    {
        $this->dateOfBirth = $value;
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

    public function getPhone(): string
    {
        return HtmlDecode($this->phone);
    }

    public function setPhone(string $value): static
    {
        $this->phone = RemoveXss($value);
        return $this;
    }

    public function getEmailAddress(): ?string
    {
        return HtmlDecode($this->emailAddress);
    }

    public function setEmailAddress(?string $value): static
    {
        $this->emailAddress = RemoveXss($value);
        return $this;
    }

    public function getCountyName(): string
    {
        return HtmlDecode($this->countyName);
    }

    public function setCountyName(string $value): static
    {
        $this->countyName = RemoveXss($value);
        return $this;
    }

    public function getSubCounty(): ?string
    {
        return HtmlDecode($this->subCounty);
    }

    public function setSubCounty(?string $value): static
    {
        $this->subCounty = RemoveXss($value);
        return $this;
    }

    public function getMaritalStatus(): ?string
    {
        return HtmlDecode($this->maritalStatus);
    }

    public function setMaritalStatus(?string $value): static
    {
        $this->maritalStatus = RemoveXss($value);
        return $this;
    }

    public function getNextOfKin(): string
    {
        return HtmlDecode($this->nextOfKin);
    }

    public function setNextOfKin(string $value): static
    {
        $this->nextOfKin = RemoveXss($value);
        return $this;
    }

    public function getNextOfKinPhone(): string
    {
        return HtmlDecode($this->nextOfKinPhone);
    }

    public function setNextOfKinPhone(string $value): static
    {
        $this->nextOfKinPhone = RemoveXss($value);
        return $this;
    }

    public function getRegistrationMonth(): ?string
    {
        return HtmlDecode($this->registrationMonth);
    }

    public function setRegistrationMonth(?string $value): static
    {
        $this->registrationMonth = RemoveXss($value);
        return $this;
    }

    public function getRegistrrationDate(): DateTime
    {
        return $this->registrrationDate;
    }

    public function setRegistrrationDate(DateTime $value): static
    {
        $this->registrrationDate = $value;
        return $this;
    }
}
