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
 * Entity class for "patientsvisitsreport" table
 */
#[Entity]
#[Table(name: "patientsvisitsreport")]
class Patientsvisitsreport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(type: "string")]
    private string $title;

    #[Column(name: "doctor_id", type: "integer")]
    private int $doctorId;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "first_name", type: "string")]
    private string $firstName;

    #[Column(name: "last_name", type: "string")]
    private string $lastName;

    #[Column(name: "next_of_kin", type: "string")]
    private string $nextOfKin;

    #[Column(name: "next_of_kin_phone", type: "string")]
    private string $nextOfKinPhone;

    #[Column(name: "visit_type", type: "string")]
    private string $visitType;

    #[Column(name: "doctor_name", type: "string", nullable: true)]
    private ?string $doctorName;

    #[Column(name: "payment_method", type: "string")]
    private string $paymentMethod;

    #[Column(type: "string")]
    private string $company;

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

    public function getDoctorId(): int
    {
        return $this->doctorId;
    }

    public function setDoctorId(int $value): static
    {
        $this->doctorId = $value;
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

    public function getFirstName(): string
    {
        return HtmlDecode($this->firstName);
    }

    public function setFirstName(string $value): static
    {
        $this->firstName = RemoveXss($value);
        return $this;
    }

    public function getLastName(): string
    {
        return HtmlDecode($this->lastName);
    }

    public function setLastName(string $value): static
    {
        $this->lastName = RemoveXss($value);
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

    public function getVisitType(): string
    {
        return HtmlDecode($this->visitType);
    }

    public function setVisitType(string $value): static
    {
        $this->visitType = RemoveXss($value);
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

    public function getPaymentMethod(): string
    {
        return HtmlDecode($this->paymentMethod);
    }

    public function setPaymentMethod(string $value): static
    {
        $this->paymentMethod = RemoveXss($value);
        return $this;
    }

    public function getCompany(): string
    {
        return HtmlDecode($this->company);
    }

    public function setCompany(string $value): static
    {
        $this->company = RemoveXss($value);
        return $this;
    }
}
