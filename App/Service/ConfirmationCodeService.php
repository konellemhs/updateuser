<?php

namespace App\Service;

use App\Entity\ConfirmationCode;
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
     * Генерация кода подтверждения
     *
     * @return string
     */
    private function generateValue(): string
    {
        return '1111';
    }
}
