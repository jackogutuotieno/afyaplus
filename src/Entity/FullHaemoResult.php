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
 * Entity class for "full_haemo_results" table
 */
#[Entity]
#[Table(name: "full_haemo_results")]
class FullHaemoResult extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "lab_test_report_id", type: "integer")]
    private int $labTestReportId;

    #[Column(type: "string")]
    private string $test;

    #[Column(type: "float")]
    private float $results;

    #[Column(type: "string")]
    private string $unit;

    #[Column(name: "unit_references", type: "string")]
    private string $unitReferences;

    #[Column(type: "text", nullable: true)]
    private ?string $comment;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getLabTestReportId(): int
    {
        return $this->labTestReportId;
    }

    public function setLabTestReportId(int $value): static
    {
        $this->labTestReportId = $value;
        return $this;
    }

    public function getTest(): string
    {
        return HtmlDecode($this->test);
    }

    public function setTest(string $value): static
    {
        $this->test = RemoveXss($value);
        return $this;
    }

    public function getResults(): float
    {
        return $this->results;
    }

    public function setResults(float $value): static
    {
        $this->results = $value;
        return $this;
    }

    public function getUnit(): string
    {
        return HtmlDecode($this->unit);
    }

    public function setUnit(string $value): static
    {
        $this->unit = RemoveXss($value);
        return $this;
    }

    public function getUnitReferences(): string
    {
        return HtmlDecode($this->unitReferences);
    }

    public function setUnitReferences(string $value): static
    {
        $this->unitReferences = RemoveXss($value);
        return $this;
    }

    public function getComment(): ?string
    {
        return HtmlDecode($this->comment);
    }

    public function setComment(?string $value): static
    {
        $this->comment = RemoveXss($value);
        return $this;
    }
}
