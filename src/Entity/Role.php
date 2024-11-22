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
 * Entity class for "roles" table
 */
#[Entity]
#[Table(name: "roles")]
class Role extends AbstractEntity
{
    #[Id]
    #[Column(name: "role_id", type: "integer", unique: true)]
    #[GeneratedValue]
    private int $roleId;

    #[Column(name: "role_name", type: "string")]
    private string $roleName;

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setRoleId(int $value): static
    {
        $this->roleId = $value;
        return $this;
    }

    public function getRoleName(): string
    {
        return HtmlDecode($this->roleName);
    }

    public function setRoleName(string $value): static
    {
        $this->roleName = RemoveXss($value);
        return $this;
    }
}
