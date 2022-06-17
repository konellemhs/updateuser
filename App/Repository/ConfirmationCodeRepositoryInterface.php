<?php

namespace App\Repository;

use App\Entity\ConfirmationCode;

interface ConfirmationCodeRepositoryInterface
{
    /**
     * @param ConfirmationCode $code
     *
     * @return ConfirmationCode
     */
    public function add(ConfirmationCode $code): ConfirmationCode;

    /**
     * @return void
     */
    public function flush(): void;
}
