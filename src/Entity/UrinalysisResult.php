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
 * Entity class for "urinalysis_results" table
 */
#[Entity]
#[Table(name: "urinalysis_results")]
class UrinalysisResult extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "lab_test_reports_id", type: "integer")]
    private int $labTestReportsId;

    #[Column(type: "string")]
    private string $parameter;

    #[Column(type: "string")]
    private string $result;

    #[Column(type: "text")]
    private string $comments;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getLabTestReportsId(): int
    {
        return $this->labTestReportsId;
    }

    public function setLabTestReportsId(int $value): static
    {
        $this->labTestReportsId = $value;
        return $this;
    }

    public function getParameter(): string
    {
        return HtmlDecode($this->parameter);
    }

    public function setParameter(string $value): static
    {
        $this->parameter = RemoveXss($value);
        return $this;
    }

    public function getResult(): string
    {
        return HtmlDecode($this->result);
    }

    public function setResult(string $value): static
    {
        $this->result = RemoveXss($value);
        return $this;
    }

    public function getComments(): string
    {
        return HtmlDecode($this->comments);
    }

    public function setComments(string $value): static
    {
        $this->comments = RemoveXss($value);
        return $this;
    }
}
