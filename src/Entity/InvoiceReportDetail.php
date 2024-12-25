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
 * Entity class for "invoice_report_details" table
 */
#[Entity]
#[Table(name: "invoice_report_details")]
class InvoiceReportDetail extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "invoice_id", type: "integer")]
    private int $invoiceId;

    #[Column(type: "string")]
    private string $item;

    #[Column(type: "integer")]
    private int $quantity;

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

    public function getInvoiceId(): int
    {
        return $this->invoiceId;
    }

    public function setInvoiceId(int $value): static
    {
        $this->invoiceId = $value;
        return $this;
    }

    public function getItem(): string
    {
        return HtmlDecode($this->item);
    }

    public function setItem(string $value): static
    {
        $this->item = RemoveXss($value);
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $value): static
    {
        $this->quantity = $value;
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
