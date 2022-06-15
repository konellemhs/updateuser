<?php

namespace App\Repository;

use App\Entity\ConfirmationCode;
use App\Entity\UserSetting;

interface UserSettingRepositoryInterface
{
    /**
     * @param UserSetting $setting
     *
     * @return UserSetting
     */
    public function add(UserSetting $setting): UserSetting;
}
