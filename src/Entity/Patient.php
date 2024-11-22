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
 * Entity class for "patients" table
 */
#[Entity]
#[Table(name: "patients")]
class Patient extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(type: "blob", nullable: true)]
    private mixed $photo;

    #[Column(name: "first_name", type: "string")]
    private string $firstName;

    #[Column(name: "last_name", type: "string")]
    private string $lastName;

    #[Column(name: "national_id", type: "integer", nullable: true)]
    private ?int $nationalId;

    #[Column(name: "date_of_birth", type: "date")]
    private DateTime $dateOfBirth;

    #[Column(type: "string")]
    private string $gender;

    #[Column(type: "string")]
    private string $phone;

    #[Column(name: "email_address", type: "string", nullable: true)]
    private ?string $emailAddress;

    #[Column(name: "physical_address", type: "text", nullable: true)]
    private ?string $physicalAddress;

    #[Column(name: "employment_status", type: "string", nullable: true)]
    private ?string $employmentStatus;

    #[Column(type: "string", nullable: true)]
    private ?string $religion;

    #[Column(name: "next_of_kin", type: "string")]
    private string $nextOfKin;

    #[Column(name: "next_of_kin_phone", type: "string")]
    private string $nextOfKinPhone;

    #[Column(name: "marital_status", type: "string")]
    private string $maritalStatus;

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

    public function getPhoto(): mixed
    {
        return $this->photo;
    }

    public function setPhoto(mixed $value): static
    {
        $this->photo = $value;
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

    public function getNationalId(): ?int
    {
        return $this->nationalId;
    }

    public function setNationalId(?int $value): static
    {
        $this->nationalId = $value;
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

    public function getPhysicalAddress(): ?string
    {
        return HtmlDecode($this->physicalAddress);
    }

    public function setPhysicalAddress(?string $value): static
    {
        $this->physicalAddress = RemoveXss($value);
        return $this;
    }

    public function getEmploymentStatus(): ?string
    {
        return HtmlDecode($this->employmentStatus);
    }

    public function setEmploymentStatus(?string $value): static
    {
        $this->employmentStatus = RemoveXss($value);
        return $this;
    }

    public function getReligion(): ?string
    {
        return HtmlDecode($this->religion);
    }

    public function setReligion(?string $value): static
    {
        $this->religion = RemoveXss($value);
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

    public function getMaritalStatus(): string
    {
        return HtmlDecode($this->maritalStatus);
    }

    public function setMaritalStatus(string $value): static
    {
        $this->maritalStatus = RemoveXss($value);
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
