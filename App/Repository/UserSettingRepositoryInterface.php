<?php

namespace App\Repository;

use App\Entity\UserSetting;
use App\Exception\EntityNotFoundException;

interface UserSettingRepositoryInterface
{
    /**
     * @param UserSetting $setting
     *
     * @return UserSetting
     */
    public function add(UserSetting $setting): UserSetting;

    /**
     * Ищет неактивную настройку пользователя по идентификатору пользователя, идентификатору настройки
     *
     * @param string $userId
     * @param int    $settingId
     *
     * @return UserSetting
     *
     * @throws EntityNotFoundException - бросается, если не найдена такая настройка пользователя
     */
    public function getInactiveUserSetting(
        string $userId,
        int $settingId
    ): UserSetting;

    /**
     * @return void
     */
    public function flush(): void;
}
