<?php

namespace App\Enum;

/**
 * Тип контакта
 */
class ContactType
{
    /**
     * смс
     */
    public const SMS = 'sms';

    /**
     * email
     */
    public const EMAIL = 'email';

    /**
     * телеграм
     */
    public const TELEGRAM = 'telegram';

    /**
     * Допустимое значение
     */
    private const VALID_VALUES = [
        self::SMS,
        self::EMAIL,
        self::TELEGRAM,
    ];

    /**
     * @var string
     */
    private string $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        if (!in_array($value, self::VALID_VALUES)) {
            throw new \InvalidArgumentException(sprintf('Недопустимое значение типа контакта %s', $value));
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
