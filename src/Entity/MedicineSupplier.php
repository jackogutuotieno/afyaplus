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
 * Entity class for "medicine_suppliers" table
 */
#[Entity]
#[Table(name: "medicine_suppliers")]
class MedicineSupplier extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "supplier_name", type: "string")]
    private string $supplierName;

    #[Column(type: "string")]
    private string $phone;

    #[Column(name: "email_address", type: "string")]
    private string $emailAddress;

    #[Column(name: "physical_address", type: "text", nullable: true)]
    private ?string $physicalAddress;

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

    public function getSupplierName(): string
    {
        return HtmlDecode($this->supplierName);
    }

    public function setSupplierName(string $value): static
    {
        $this->supplierName = RemoveXss($value);
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

    public function getEmailAddress(): string
    {
        return HtmlDecode($this->emailAddress);
    }

    public function setEmailAddress(string $value): static
    {
        $this->emailAddress = RemoveXss($value);
        return $this;
    }

    public function getPhysicalAddress(): ?string
    {
        return HtmlDecode($this->physicalAddress);
    }

    public function setPhysicalAddress(?string $value): static
    {
        $this->physicalAddress = RemoveXss($value);
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
