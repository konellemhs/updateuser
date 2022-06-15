<?php

namespace App\Infrastructure\Transport;

use App\Enum\ContactType;
use InvalidArgumentException;

/**
 * Фабрика транспорта
 */
class TransportFactory
{
    /**
     * @var SmsServiceTransport
     */
    private SmsServiceTransport $smsServiceTransport;

    /**
     * @var EmailTransport
     */
    private EmailTransport $emailTransport;

    /**
     * @var TelegramTransport
     */
    private TelegramTransport $telegramTransport;

    /**
     * @param SmsServiceTransport $smsServiceTransport
     * @param EmailTransport      $emailTransport
     * @param TelegramTransport   $telegramTransport
     */
    public function __construct(
        SmsServiceTransport $smsServiceTransport,
        EmailTransport      $emailTransport,
        TelegramTransport   $telegramTransport
    ) {
        $this->smsServiceTransport = $smsServiceTransport;
        $this->emailTransport = $emailTransport;
        $this->telegramTransport = $telegramTransport;
    }

    /**
     * @param ContactType $type
     *
     * @return TransportInterface
     */
    public function getTransportByContactType(ContactType $type): TransportInterface
    {
        return match ($type->getValue()) {
            ContactType::SMS => $this->smsServiceTransport,
            ContactType::EMAIL => $this->emailTransport,
            ContactType::TELEGRAM => $this->telegramTransport,
            default => throw new InvalidArgumentException(
                sprintf('Транспорт для типа %s не определен', $type->getValue())
            ),
        };
    }
}
