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
 * Entity class for "lab_test_requests_queue" table
 */
#[Entity]
#[Table(name: "lab_test_requests_queue")]
class LabTestRequestsQueue extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "lab_test_requests_details_id", type: "integer")]
    private int $labTestRequestsDetailsId;

    #[Column(name: "waiting_time", type: "integer")]
    private int $waitingTime;

    #[Column(name: "waiting_interval", type: "string")]
    private string $waitingInterval;

    #[Column(type: "string")]
    private string $status;

    #[Column(name: "created_by_user_id", type: "integer")]
    private int $createdByUserId;

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

    public function getLabTestRequestsDetailsId(): int
    {
        return $this->labTestRequestsDetailsId;
    }

    public function setLabTestRequestsDetailsId(int $value): static
    {
        $this->labTestRequestsDetailsId = $value;
        return $this;
    }

    public function getWaitingTime(): int
    {
        return $this->waitingTime;
    }

    public function setWaitingTime(int $value): static
    {
        $this->waitingTime = $value;
        return $this;
    }

    public function getWaitingInterval(): string
    {
        return HtmlDecode($this->waitingInterval);
    }

    public function setWaitingInterval(string $value): static
    {
        $this->waitingInterval = RemoveXss($value);
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

    public function getCreatedByUserId(): int
    {
        return $this->createdByUserId;
    }

    public function setCreatedByUserId(int $value): static
    {
        $this->createdByUserId = $value;
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
