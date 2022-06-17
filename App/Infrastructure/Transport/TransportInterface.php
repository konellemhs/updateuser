<?php

namespace App\Infrastructure\Transport;

use App\DTO\Template\TemplateData;

interface TransportInterface
{
    /**
     * Отправить сообщение $message по идентификатору $identifier
     *
     * @param string       $identifier
     * @param TemplateData $message
     *
     * @return void
     */
    public function sendMessage(string $identifier, TemplateData $message): void;
}
