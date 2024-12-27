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
 * Entity class for "ipd_patients" table
 */
#[Entity]
#[Table(name: "ipd_patients")]
class IpdPatient extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(name: "national_id", type: "integer", nullable: true)]
    private ?int $nationalId;

    #[Column(name: "date_of_birth", type: "date")]
    private DateTime $dateOfBirth;

    #[Column(type: "bigint", nullable: true)]
    private ?string $age;

    #[Column(type: "string")]
    private string $gender;

    #[Column(type: "string")]
    private string $phone;

    #[Column(name: "is_ipd", type: "boolean")]
    private bool $isIpd;

    public function __construct()
    {
        $this->isIpd = false;
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

    public function getPatientName(): ?string
    {
        return HtmlDecode($this->patientName);
    }

    public function setPatientName(?string $value): static
    {
        $this->patientName = RemoveXss($value);
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

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $value): static
    {
        $this->age = $value;
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

    public function getIsIpd(): bool
    {
        return $this->isIpd;
    }

    public function setIsIpd(bool $value): static
    {
        $this->isIpd = $value;
        return $this;
    }
}
