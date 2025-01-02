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
 * Entity class for "leave_balance" table
 */
#[Entity]
#[Table(name: "leave_balance")]
class LeaveBalance extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "leave_category", type: "string")]
    private string $leaveCategory;

    #[Column(name: "maximum_days", type: "integer")]
    private int $maximumDays;

    #[Column(name: "user_id", type: "integer")]
    private int $userId;

    #[Column(name: "leave_category_id", type: "integer")]
    private int $leaveCategoryId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getLeaveCategory(): string
    {
        return HtmlDecode($this->leaveCategory);
    }

    public function setLeaveCategory(string $value): static
    {
        $this->leaveCategory = RemoveXss($value);
        return $this;
    }

    public function getMaximumDays(): int
    {
        return $this->maximumDays;
    }

    public function setMaximumDays(int $value): static
    {
        $this->maximumDays = $value;
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
}
