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
 * Entity class for "employees_view" table
 */
#[Entity]
#[Table(name: "employees_view")]
class EmployeesView extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "employee_name", type: "string", nullable: true)]
    private ?string $employeeName;

    #[Column(name: "national_id", type: "integer")]
    private int $nationalId;

    #[Column(type: "string")]
    private string $gender;

    #[Column(type: "string")]
    private string $phone;

    #[Column(type: "string")]
    private string $email;

    #[Column(name: "department_name", type: "string")]
    private string $departmentName;

    #[Column(type: "string")]
    private string $designation;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getEmployeeName(): ?string
    {
        return HtmlDecode($this->employeeName);
    }

    public function setEmployeeName(?string $value): static
    {
        $this->employeeName = RemoveXss($value);
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

    public function getDepartmentName(): string
    {
        return HtmlDecode($this->departmentName);
    }

    public function setDepartmentName(string $value): static
    {
        $this->departmentName = RemoveXss($value);
        return $this;
    }

    public function getDesignation(): string
    {
        return HtmlDecode($this->designation);
    }

    public function setDesignation(string $value): static
    {
        $this->designation = RemoveXss($value);
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
}
