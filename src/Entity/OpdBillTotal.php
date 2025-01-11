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
 * Entity class for "opd_bill_total" table
 */
#[Entity]
#[Table(name: "opd_bill_total")]
class OpdBillTotal extends AbstractEntity
{
    #[Column(type: "integer")]
    private int $id;

    #[Column(name: "opd_total_bill", type: "float", nullable: true)]
    private ?float $opdTotalBill;

    public function __construct()
    {
        $this->id = 0;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getOpdTotalBill(): ?float
    {
        return $this->opdTotalBill;
    }

    public function setOpdTotalBill(?float $value): static
    {
        $this->opdTotalBill = $value;
        return $this;
    }
}
