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
 * Entity class for "laboratory_billing_report_details" table
 */
#[Entity]
#[Table(name: "laboratory_billing_report_details")]
class LaboratoryBillingReportDetail extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "lab_test_request_id", type: "integer")]
    private int $labTestRequestId;

    #[Column(name: "service_name", type: "string")]
    private string $serviceName;

    #[Column(type: "float")]
    private float $cost;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getLabTestRequestId(): int
    {
        return $this->labTestRequestId;
    }

    public function setLabTestRequestId(int $value): static
    {
        $this->labTestRequestId = $value;
        return $this;
    }

    public function getServiceName(): string
    {
        return HtmlDecode($this->serviceName);
    }

    public function setServiceName(string $value): static
    {
        $this->serviceName = RemoveXss($value);
        return $this;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public function setCost(float $value): static
    {
        $this->cost = $value;
        return $this;
    }
}