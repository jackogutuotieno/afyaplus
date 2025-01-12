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
 * Entity class for "ipd_bed_charges" table
 */
#[Entity]
#[Table(name: "ipd_bed_charges")]
class IpdBedCharge extends AbstractEntity
{
    #[Column(name: "admission_id", type: "integer")]
    private int $admissionId;

    #[Column(name: "bed_charges", type: "float")]
    private float $bedCharges;

    public function getAdmissionId(): int
    {
        return $this->admissionId;
    }

    public function setAdmissionId(int $value): static
    {
        $this->admissionId = $value;
        return $this;
    }

    public function getBedCharges(): float
    {
        return $this->bedCharges;
    }

    public function setBedCharges(float $value): static
    {
        $this->bedCharges = $value;
        return $this;
    }
}
