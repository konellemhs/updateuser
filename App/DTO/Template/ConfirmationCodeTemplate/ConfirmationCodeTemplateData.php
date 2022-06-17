<?php

namespace App\DTO\Template\ConfirmationCodeTemplate;

use App\DTO\Template\TemplateData;

final class ConfirmationCodeTemplateData extends TemplateData
{
    /**
     * Текст шаблона
     */
    private const TEMPLATE_TEXT = '{{.code}} - код подтверждения смены настроек';

    /**
     * @var string
     */
    private string $code;

    /**
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return array
     */
    protected function getVars(): array
    {
        return ['code' => $this->code];
    }

    /**
     * @return string
     */
    protected function getTemplateText(): string
    {
        return self::TEMPLATE_TEXT;
    }
}
