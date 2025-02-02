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
 * Entity class for "beds_status" table
 */
#[Entity]
#[Table(name: "beds_status")]
class BedsStatus extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "floor_name", type: "string")]
    private string $floorName;

    #[Column(name: "ward_type", type: "string")]
    private string $wardType;

    #[Column(name: "ward_name", type: "string")]
    private string $wardName;

    #[Column(name: "bed_name", type: "string")]
    private string $bedName;

    #[Column(type: "string")]
    private string $status;

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

    public function getFloorName(): string
    {
        return HtmlDecode($this->floorName);
    }

    public function setFloorName(string $value): static
    {
        $this->floorName = RemoveXss($value);
        return $this;
    }

    public function getWardType(): string
    {
        return HtmlDecode($this->wardType);
    }

    public function setWardType(string $value): static
    {
        $this->wardType = RemoveXss($value);
        return $this;
    }

    public function getWardName(): string
    {
        return HtmlDecode($this->wardName);
    }

    public function setWardName(string $value): static
    {
        $this->wardName = RemoveXss($value);
        return $this;
    }

    public function getBedName(): string
    {
        return HtmlDecode($this->bedName);
    }

    public function setBedName(string $value): static
    {
        $this->bedName = RemoveXss($value);
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
}
