<?php

namespace App\Infrastructure\Transport;

class TelegramTransport implements TransportInterface
{
    /**
     * @param string $identifier
     * @param string $message
     *
     * @return void
     */
    public function sendMessage(string $identifier, string $message): void
    {
        // TODO: Implement sendMessage() method.
    }
}
