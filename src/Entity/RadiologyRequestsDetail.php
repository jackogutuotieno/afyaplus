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
 * Entity class for "radiology_requests_details" table
 */
#[Entity]
#[Table(name: "radiology_requests_details")]
class RadiologyRequestsDetail extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "radiology_request_id", type: "integer")]
    private int $radiologyRequestId;

    #[Column(name: "service_id", type: "integer")]
    private int $serviceId;

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

    public function getRadiologyRequestId(): int
    {
        return $this->radiologyRequestId;
    }

    public function setRadiologyRequestId(int $value): static
    {
        $this->radiologyRequestId = $value;
        return $this;
    }

    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    public function setServiceId(int $value): static
    {
        $this->serviceId = $value;
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
