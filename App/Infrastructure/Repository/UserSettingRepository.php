<?php

namespace App\Infrastructure\Repository;

use App\Entity\UserSetting;
use App\Repository\UserSettingRepositoryInterface;

class UserSettingRepository implements UserSettingRepositoryInterface
{
    /**
     * @param UserSetting $setting
     *
     * @return UserSetting
     */
    public function add(UserSetting $setting): UserSetting
    {
        // TODO: Implement add() method.
    }

    /**
     * @param string $userId
     * @param int    $settingId
     *
     * @return UserSetting
     */
    public function getInactiveUserSetting(string $userId, int $settingId): UserSetting
    {
        // TODO: Implement getInactiveUserSetting() method.
    }

    /**
     * @return void
     */
    public function flush(): void
    {
        // TODO: Implement flush() method.
    }
}
