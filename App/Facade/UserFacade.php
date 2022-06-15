<?php

namespace App\Facade;

use App\Entity\User;
use App\Entity\UserSetting;
use App\Enum\ContactType;
use App\Infrastructure\Transport\TransportFactory;
use App\Service\ConfirmationCodeService;
use App\Service\UserService;
use App\Service\UserSettingService;

class UserFacade
{
    /**
     * @var ConfirmationCodeService
     */
    private ConfirmationCodeService $confirmationCodeService;

    /**
     * @var TransportFactory
     */
    private TransportFactory $transportFactory;

    /**
     * @var UserSettingService
     */
    private UserSettingService $settingService;

    /**
     * @param ConfirmationCodeService $confirmationCodeService
     * @param TransportFactory        $transportFactory
     * @param UserSettingService      $settingService
     */
    public function __construct(
        ConfirmationCodeService $confirmationCodeService,
        TransportFactory $transportFactory,
        UserSettingService $settingService
    ) {
        $this->confirmationCodeService = $confirmationCodeService;
        $this->transportFactory = $transportFactory;
        $this->settingService = $settingService;
    }

    /**
     * @param User        $user
     * @param UserSetting $setting
     * @param string      $newValue
     *
     * @return void
     */
    public function updateUserSettings(User $user, UserSetting $setting, string $newValue, ContactType $byContact)
    {

    }
}
