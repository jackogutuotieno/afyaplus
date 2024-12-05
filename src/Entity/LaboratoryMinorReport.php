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
 * Entity class for "laboratory_minor_report" table
 */
#[Entity]
#[Table(name: "laboratory_minor_report")]
class LaboratoryMinorReport extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "service_name", type: "string")]
    private string $serviceName;

    #[Column(name: "category_name", type: "string")]
    private string $categoryName;

    #[Column(type: "string")]
    private string $subcategory;

    #[Column(type: "text", nullable: true)]
    private ?string $details;

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

    public function getServiceName(): string
    {
        return HtmlDecode($this->serviceName);
    }

    public function setServiceName(string $value): static
    {
        $this->serviceName = RemoveXss($value);
        return $this;
    }

    public function getCategoryName(): string
    {
        return HtmlDecode($this->categoryName);
    }

    public function setCategoryName(string $value): static
    {
        $this->categoryName = RemoveXss($value);
        return $this;
    }

    public function getSubcategory(): string
    {
        return HtmlDecode($this->subcategory);
    }

    public function setSubcategory(string $value): static
    {
        $this->subcategory = RemoveXss($value);
        return $this;
    }

    public function getDetails(): ?string
    {
        return HtmlDecode($this->details);
    }

    public function setDetails(?string $value): static
    {
        $this->details = RemoveXss($value);
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
