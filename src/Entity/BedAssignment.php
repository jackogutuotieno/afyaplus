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
 * Entity class for "bed_assignment" table
 */
#[Entity]
#[Table(name: "bed_assignment")]
class BedAssignment extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "admission_id", type: "integer")]
    private int $admissionId;

    #[Column(name: "patient_id", type: "integer")]
    private int $patientId;

    #[Column(name: "floor_id", type: "integer")]
    private int $floorId;

    #[Column(name: "ward_type_id", type: "integer")]
    private int $wardTypeId;

    #[Column(name: "ward_id", type: "integer")]
    private int $wardId;

    #[Column(name: "bed_id", type: "integer")]
    private int $bedId;

    #[Column(type: "string")]
    private string $status;

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

    public function getAdmissionId(): int
    {
        return $this->admissionId;
    }

    public function setAdmissionId(int $value): static
    {
        $this->admissionId = $value;
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

    public function getFloorId(): int
    {
        return $this->floorId;
    }

    public function setFloorId(int $value): static
    {
        $this->floorId = $value;
        return $this;
    }

    public function getWardTypeId(): int
    {
        return $this->wardTypeId;
    }

    public function setWardTypeId(int $value): static
    {
        $this->wardTypeId = $value;
        return $this;
    }

    public function getWardId(): int
    {
        return $this->wardId;
    }

    public function setWardId(int $value): static
    {
        $this->wardId = $value;
        return $this;
    }

    public function getBedId(): int
    {
        return $this->bedId;
    }

    public function setBedId(int $value): static
    {
        $this->bedId = $value;
        return $this;
    }

    public function getStatus(): string
    {
        return HtmlDecode($this->status);
    }

    public function setStatus(string $value): static
    {
        $this->status = RemoveXss($value);
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
