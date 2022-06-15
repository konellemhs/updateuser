<?php

namespace App\Infrastructure\Transport;

interface TransportInterface
{
    /**
     * Отправить сообщение $message по идентификатору $identifier
     *
     * @param string $identifier
     * @param string $message
     *
     * @return void
     */
    public function sendMessage(string $identifier, string $message): void;
}
