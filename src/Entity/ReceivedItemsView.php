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
 * Entity class for "received_items_view" table
 */
#[Entity]
#[Table(name: "received_items_view")]
class ReceivedItemsView extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer")]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "batch_number", type: "string")]
    private string $batchNumber;

    #[Column(name: "item_title", type: "string")]
    private string $itemTitle;

    #[Column(name: "total_items_received", type: "integer")]
    private int $totalItemsReceived;

    #[Column(name: "measuring_unit", type: "string")]
    private string $measuringUnit;

    #[Column(name: "selling_price", type: "float")]
    private float $sellingPrice;

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

    public function getBatchNumber(): string
    {
        return HtmlDecode($this->batchNumber);
    }

    public function setBatchNumber(string $value): static
    {
        $this->batchNumber = RemoveXss($value);
        return $this;
    }

    public function getItemTitle(): string
    {
        return HtmlDecode($this->itemTitle);
    }

    public function setItemTitle(string $value): static
    {
        $this->itemTitle = RemoveXss($value);
        return $this;
    }

    public function getTotalItemsReceived(): int
    {
        return $this->totalItemsReceived;
    }

    public function setTotalItemsReceived(int $value): static
    {
        $this->totalItemsReceived = $value;
        return $this;
    }

    public function getMeasuringUnit(): string
    {
        return HtmlDecode($this->measuringUnit);
    }

    public function setMeasuringUnit(string $value): static
    {
        $this->measuringUnit = RemoveXss($value);
        return $this;
    }

    public function getSellingPrice(): float
    {
        return $this->sellingPrice;
    }

    public function setSellingPrice(float $value): static
    {
        $this->sellingPrice = $value;
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
