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
 * Entity class for "users" table
 */
#[Entity]
#[Table(name: "users")]
class User extends AbstractEntity
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

    #[Column(name: "national_id", type: "integer")]
    private int $nationalId;

    #[Column(type: "string")]
    private string $gender;

    #[Column(type: "string")]
    private string $phone;

    #[Column(type: "string")]
    private string $email;

    #[Column(name: "department_id", type: "integer")]
    private int $departmentId;

    #[Column(name: "designation_id", type: "integer")]
    private int $designationId;

    #[Column(name: "physical_address", type: "text", nullable: true)]
    private ?string $physicalAddress;

    #[Column(type: "string")]
    private string $password;

    #[Column(name: "user_role_id", type: "integer")]
    private int $userRoleId;

    #[Column(name: "account_status", type: "string", nullable: true)]
    private ?string $accountStatus;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "otp_code", type: "string", nullable: true)]
    private ?string $otpCode;

    #[Column(name: "otp_date", type: "datetime", nullable: true)]
    private ?DateTime $otpDate;

    public function __construct()
    {
        $this->userRoleId = 0;
        $this->accountStatus = "Pending";
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

    public function getNationalId(): int
    {
        return $this->nationalId;
    }

    public function setNationalId(int $value): static
    {
        $this->nationalId = $value;
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

    public function getEmail(): string
    {
        return HtmlDecode($this->email);
    }

    public function setEmail(string $value): static
    {
        $this->email = RemoveXss($value);
        return $this;
    }

    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(int $value): static
    {
        $this->departmentId = $value;
        return $this;
    }

    public function getDesignationId(): int
    {
        return $this->designationId;
    }

    public function setDesignationId(int $value): static
    {
        $this->designationId = $value;
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

    public function getPassword(): string
    {
        return HtmlDecode($this->password);
    }

    public function setPassword(string $value): static
    {
        $this->password = RemoveXss($value);
        return $this;
    }

    public function getUserRoleId(): int
    {
        return $this->userRoleId;
    }

    public function setUserRoleId(int $value): static
    {
        $this->userRoleId = $value;
        return $this;
    }

    public function getAccountStatus(): ?string
    {
        return HtmlDecode($this->accountStatus);
    }

    public function setAccountStatus(?string $value): static
    {
        $this->accountStatus = RemoveXss($value);
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

    public function getOtpCode(): ?string
    {
        return HtmlDecode($this->otpCode);
    }

    public function setOtpCode(?string $value): static
    {
        $this->otpCode = RemoveXss($value);
        return $this;
    }

    public function getOtpDate(): ?DateTime
    {
        return $this->otpDate;
    }

    public function setOtpDate(?DateTime $value): static
    {
        $this->otpDate = $value;
        return $this;
    }
}
