<?php

namespace App\Infrastructure\Repository;

use App\Entity\ConfirmationCode;
use App\Repository\ConfirmationCodeRepositoryInterface;

class ConfirmationCodeRepository implements ConfirmationCodeRepositoryInterface
{
    /**
     * @param ConfirmationCode $code
     *
     * @return ConfirmationCode
     */
    public function add(ConfirmationCode $code): ConfirmationCode
    {
        // TODO: Implement add() method.
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        // TODO: Implement flush() method.
    }
}
