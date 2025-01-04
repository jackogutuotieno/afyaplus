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
 * Entity class for "leave_applications" table
 */
#[Entity]
#[Table(name: "leave_applications")]
class LeaveApplication extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "user_id", type: "integer")]
    private int $userId;

    #[Column(name: "leave_category_id", type: "integer")]
    private int $leaveCategoryId;

    #[Column(name: "start_from_date", type: "date", nullable: true)]
    private ?DateTime $startFromDate;

    #[Column(name: "days_applied", type: "integer")]
    private int $daysApplied;

    #[Column(type: "string")]
    private string $status;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    public function __construct()
    {
        $this->status = "Pending";
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

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $value): static
    {
        $this->userId = $value;
        return $this;
    }

    public function getLeaveCategoryId(): int
    {
        return $this->leaveCategoryId;
    }

    public function setLeaveCategoryId(int $value): static
    {
        $this->leaveCategoryId = $value;
        return $this;
    }

    public function getStartFromDate(): ?DateTime
    {
        return $this->startFromDate;
    }

    public function setStartFromDate(?DateTime $value): static
    {
        $this->startFromDate = $value;
        return $this;
    }

    public function getDaysApplied(): int
    {
        return $this->daysApplied;
    }

    public function setDaysApplied(int $value): static
    {
        $this->daysApplied = $value;
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
