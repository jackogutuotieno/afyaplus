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
 * Entity class for "visits_report" table
 */
#[Entity]
#[Table(name: "visits_report")]
class VisitsReport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "first_name", type: "string")]
    private string $firstName;

    #[Column(name: "last_name", type: "string")]
    private string $lastName;

    #[Column(name: "visit_type", type: "string")]
    private string $visitType;

    #[Column(name: "payment_method", type: "string")]
    private string $paymentMethod;

    #[Column(type: "string")]
    private string $company;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    #[Column(name: "visit_month", type: "string", nullable: true)]
    private ?string $visitMonth;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getFirstName(): string
    {
        return HtmlDecode($this->firstName);
    }

    public function setFirstName(string $value): static
    {
        $this->firstName = RemoveXss($value);
        return $this;
    }

    public function getLastName(): string
    {
        return HtmlDecode($this->lastName);
    }

    public function setLastName(string $value): static
    {
        $this->lastName = RemoveXss($value);
        return $this;
    }

    public function getVisitType(): string
    {
        return HtmlDecode($this->visitType);
    }

    public function setVisitType(string $value): static
    {
        $this->visitType = RemoveXss($value);
        return $this;
    }

    public function getPaymentMethod(): string
    {
        return HtmlDecode($this->paymentMethod);
    }

    public function setPaymentMethod(string $value): static
    {
        $this->paymentMethod = RemoveXss($value);
        return $this;
    }

    public function getCompany(): string
    {
        return HtmlDecode($this->company);
    }

    public function setCompany(string $value): static
    {
        $this->company = RemoveXss($value);
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

    public function getVisitMonth(): ?string
    {
        return HtmlDecode($this->visitMonth);
    }

    public function setVisitMonth(?string $value): static
    {
        $this->visitMonth = RemoveXss($value);
        return $this;
    }
}
