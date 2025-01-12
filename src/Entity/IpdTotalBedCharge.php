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
 * Entity class for "ipd_total_bed_charges" table
 */
#[Entity]
#[Table(name: "ipd_total_bed_charges")]
class IpdTotalBedCharge extends AbstractEntity
{
    #[Column(name: "admission_id", type: "integer")]
    private int $admissionId;

    #[Column(name: "total_bed_charges", type: "float", nullable: true)]
    private ?float $totalBedCharges;

    public function __construct()
    {
        $this->admissionId = 0;
    }

    public function getAdmissionId(): int
    {
        return $this->admissionId;
    }

    public function setAdmissionId(int $value): static
    {
        $this->admissionId = $value;
        return $this;
    }

    public function getTotalBedCharges(): ?float
    {
        return $this->totalBedCharges;
    }

    public function setTotalBedCharges(?float $value): static
    {
        $this->totalBedCharges = $value;
        return $this;
    }
}
