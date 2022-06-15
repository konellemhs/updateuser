<?php

namespace App\Entity;

use DateTimeImmutable;

/**
 * Код подтверждения
 */
final class ConfirmationCode
{
    /**
     * @var int
     */
    private int $id;

    /**
     * Значение кода подтверждения
     *
     * @var string
     */
    private string $value;

    /**
     * Дата создания
     *
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $createdAt;

    /**
     * Дата протухания
     *
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $expiredAt;

    /**
     * флаг активности кода
     *
     * @var bool
     */
    private bool $isActive;

    /**
     * @param string            $value
     * @param DateTimeImmutable $createdAt
     * @param DateTimeImmutable $expiredAt
     * @param bool              $isActive
     */
    public function __construct(
        string $value,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $expiredAt,
        bool $isActive = true
    ) {
        $this->value = $value;
        $this->createdAt = $createdAt;
        $this->expiredAt = $expiredAt;
        $this->isActive = $isActive;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getExpiredAt(): DateTimeImmutable
    {
        return $this->expiredAt;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }
}
