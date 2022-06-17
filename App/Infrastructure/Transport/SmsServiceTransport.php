<?php

namespace App\Infrastructure\Transport;

use App\DTO\Template\TemplateData;

class SmsServiceTransport implements TransportInterface
{
    /**
     * @param string       $identifier
     * @param TemplateData $message
     *
     * @return void
     */
    public function sendMessage(string $identifier, TemplateData $message): void
    {
        // TODO: Implement sendMessage() method.
    }
}
