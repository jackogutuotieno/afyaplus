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
 * Entity class for "branding" table
 */
#[Entity]
#[Table(name: "branding")]
class Branding extends AbstractEntity
{
    #[Id]
    #[Column(type: "integer", unique: true)]
    #[GeneratedValue]
    private int $id;

    #[Column(name: "header_image", type: "blob")]
    private mixed $headerImage;

    #[Column(name: "date_created", type: "datetime")]
    private DateTime $dateCreated;

    #[Column(name: "date_updated", type: "datetime")]
    private DateTime $dateUpdated;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $value): static
    {
        $this->id = $value;
        return $this;
    }

    public function getHeaderImage(): mixed
    {
        return $this->headerImage;
    }

    public function setHeaderImage(mixed $value): static
    {
        $this->headerImage = $value;
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

    public function getDateUpdated(): DateTime
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(DateTime $value): static
    {
        $this->dateUpdated = $value;
        return $this;
    }
}
