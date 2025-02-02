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
 * Entity class for "sub_county" table
 */
#[Entity]
#[Table(name: "sub_county")]
class SubCounty extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "county_id", type: "integer")]
    private int $countyId;

    #[Column(type: "string", nullable: true)]
    private ?string $countyName;

    #[Column(type: "string", nullable: true)]
    private ?string $subCounty;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getCountyId(): int
    {
        return $this->countyId;
    }

    public function setCountyId(int $value): static
    {
        $this->countyId = $value;
        return $this;
    }

    public function getCountyName(): ?string
    {
        return HtmlDecode($this->countyName);
    }

    public function setCountyName(?string $value): static
    {
        $this->countyName = RemoveXss($value);
        return $this;
    }

    public function getSubCounty(): ?string
    {
        return HtmlDecode($this->subCounty);
    }

    public function setSubCounty(?string $value): static
    {
        $this->subCounty = RemoveXss($value);
        return $this;
    }
}
