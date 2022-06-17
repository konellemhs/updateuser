<?php

namespace App\Entity;

/**
 * Настройка пользователя
 */
final class UserSetting
{
    /**
     * автогенерируемый
     *
     * @var int
     */
    private int $id;

    /**
     * Связь ManyToOne
     *
     * @var User
     */
    private User $user;

    /**
     * Связь ManyToOne
     *
     * @var Setting
     */
    private Setting $setting;

    /**
     * Значение настройки пользователя
     *
     * @var string
     */
    private string $value;

    /**
     * Флаг активности настройки
     *
     * @var bool
     */
    private bool $isActive;

    /**
     * Опциональная связь на код подтверждения
     *
     * @var ConfirmationCode | null
     */
    private ?ConfirmationCode $code;

    /**
     * @param User                    $user
     * @param Setting                 $setting
     * @param string                  $value
     * @param bool                    $isActive
     * @param ConfirmationCode | null $code
     */
    public function __construct(
        User $user,
        Setting $setting,
        string $value,
        bool $isActive,
        ?ConfirmationCode $code
    ) {
        $this->user = $user;
        $this->setting = $setting;
        $this->value = $value;
        $this->isActive = $isActive;
        $this->code = $code;
    }

    /**
     * @return UserSetting
     */
    public function activate(): self
    {
        $this->isActive = true;

        return $this;
    }

    /**
     * @return UserSetting
     */
    public function deactivate(): self
    {
        $this->isActive = false;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Setting
     */
    public function getSetting(): Setting
    {
        return $this->setting;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return ConfirmationCode|null
     */
    public function getCode(): ?ConfirmationCode
    {
        return $this->code;
    }
}
