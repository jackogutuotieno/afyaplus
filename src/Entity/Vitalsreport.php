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
 * Entity class for "vitalsreport" table
 */
#[Entity]
#[Table(name: "vitalsreport")]
class Vitalsreport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(type: "float")]
    private float $height;

    #[Column(type: "integer")]
    private int $weight;

    #[Column(type: "float")]
    private float $temperature;

    #[Column(type: "integer")]
    private int $pulse;

    #[Column(name: "blood_pressure", type: "string")]
    private string $bloodPressure;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "patient_name", type: "string", nullable: true)]
    private ?string $patientName;

    #[Column(type: "string", nullable: true)]
    private ?string $nurse;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function setHeight(float $value): static
    {
        $this->height = $value;
        return $this;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $value): static
    {
        $this->weight = $value;
        return $this;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function setTemperature(float $value): static
    {
        $this->temperature = $value;
        return $this;
    }

    public function getPulse(): int
    {
        return $this->pulse;
    }

    public function setPulse(int $value): static
    {
        $this->pulse = $value;
        return $this;
    }

    public function getBloodPressure(): string
    {
        return HtmlDecode($this->bloodPressure);
    }

    public function setBloodPressure(string $value): static
    {
        $this->bloodPressure = RemoveXss($value);
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

    public function getNurse(): ?string
    {
        return HtmlDecode($this->nurse);
    }

    public function setNurse(?string $value): static
    {
        $this->nurse = RemoveXss($value);
        return $this;
    }
}
