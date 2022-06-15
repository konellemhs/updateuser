<?php

namespace App\Service;

use App\Entity\ConfirmationCode;
use App\Entity\Setting;
use App\Entity\User;
use App\Entity\UserSetting;
use App\Repository\UserSettingRepositoryInterface;

class UserSettingService
{
    /**
     * @var UserSettingRepositoryInterface
     */
    private UserSettingRepositoryInterface $userSettingRepository;

    /**
     * @param UserSettingRepositoryInterface $userSettingRepository
     */
    public function __construct(UserSettingRepositoryInterface $userSettingRepository)
    {
        $this->userSettingRepository = $userSettingRepository;
    }

    /**
     * @param User             $user
     * @param Setting          $setting
     * @param string           $value
     * @param ConfirmationCode $code
     *
     * @return UserSetting
     */
    public function createInactiveUserSetting(User $user, Setting $setting, string $value, ConfirmationCode $code): UserSetting
    {
        return $this->userSettingRepository->add(
            new UserSetting(
                $user,
                $setting,
                $value,
                false,
                $code,
            )
        );
    }
}
