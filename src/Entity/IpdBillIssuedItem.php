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
 * Entity class for "ipd_bill_issued_items" table
 */
#[Entity]
#[Table(name: "ipd_bill_issued_items")]
class IpdBillIssuedItem extends AbstractEntity
{
    #[Id]
    #[Column(name: "admission_id", type: "integer")]
    #[GeneratedValue]
    private int $admissionId;

    #[Column(name: "item_title", type: "string")]
    private string $itemTitle;

    #[Column(type: "integer")]
    private int $quantity;

    #[Column(name: "selling_price", type: "float")]
    private float $sellingPrice;

    public function getAdmissionId(): int
    {
        return $this->admissionId;
    }

    public function setAdmissionId(int $value): static
    {
        $this->admissionId = $value;
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

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $value): static
    {
        $this->quantity = $value;
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
}
