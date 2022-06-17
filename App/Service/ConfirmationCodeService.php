<?php

namespace App\Service;

use App\Entity\ConfirmationCode;
use App\Exception\ConfirmationCodeInvalidException;
use App\Repository\ConfirmationCodeRepositoryInterface;
use DateTimeImmutable;

class ConfirmationCodeService
{
    /**
     * @var string
     */
    private string $codeLifeTime;

    /**
     * @var ConfirmationCodeRepositoryInterface
     */
    private ConfirmationCodeRepositoryInterface $confirmationCodeRepository;

    /**
     * @param string                              $codeLifeTime
     * @param ConfirmationCodeRepositoryInterface $confirmationCodeRepository
     */
    public function __construct(
        ConfirmationCodeRepositoryInterface $confirmationCodeRepository,
        string $codeLifeTime
    ) {
        $this->codeLifeTime = $codeLifeTime;
        $this->confirmationCodeRepository = $confirmationCodeRepository;
    }

    /**
     * @return ConfirmationCode
     */
    public function create(): ConfirmationCode
    {
        return $this->confirmationCodeRepository->add(
            new ConfirmationCode(
                $this->generateValue(),
                new DateTimeImmutable(),
                (new DateTimeImmutable())->modify($this->codeLifeTime)
            )
        );
    }

    /**
     * @param ConfirmationCode $code
     * @param string           $codeValue
     *
     * @return void
     *
     * @throws ConfirmationCodeInvalidException
     */
    public function validateCode(ConfirmationCode $code, string $actualCodeValue): void
    {
        if (!$code->isActive()) {
            throw new ConfirmationCodeInvalidException('Код неактивен. Запросите новый');
        }

        if ($actualCodeValue !== $code->getValue()) {
            throw new ConfirmationCodeInvalidException('Неверный код подтверждения');
        }

        if ((new DateTimeImmutable()) > $code->getExpiredAt()) {
            $this->deactivateCode($code);

            throw new ConfirmationCodeInvalidException('Истекло время жизни кода подтверждения. Запросите новый');
        }
    }

    /**
     * @param ConfirmationCode $code
     *
     * @return void
     */
    public function deactivateCode(ConfirmationCode $code): void
    {
        $code->deactivate();

        $this->confirmationCodeRepository->flush();
    }

    /**
     * Генерация кода подтверждения
     *
     * @return string
     */
    private function generateValue(): string
    {
        return '1111';
    }
}
