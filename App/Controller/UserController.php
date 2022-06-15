<?php

namespace App\Controller;

use App\DTO\UpdateUserSettingData;
use App\Entity\User;
use App\Entity\UserSetting;
use App\Enum\ContactType;
use App\Facade\UserFacade;

final class UserController
{
    /**
     * @var UserFacade
     */
    private UserFacade $facade;

    /**
     * @param UserFacade $facade
     */
    public function __construct(UserFacade $facade)
    {
        $this->facade = $facade;
    }

    /**
     * Получение пользователя, запрос get /user
     *
     * @param User $user
     *
     * @return User
     */
    public function getUser(User $user): User
    {
        return $user;
    }

    /**
     * Получение контактов пользователя, запрос get /user/{id}/contact
     *
     * @param User $user
     *
     * @return array
     */
    public function getUserContact(User $user): array
    {
        return $user->getContacts();
    }

    /**
     * Получение контактов пользователя, запрос put /user/{id}/setting/id
     *
     * @param User                  $user
     * @param UserSetting           $userSetting
     * @param UpdateUserSettingData $updateUserSettingData
     * @param ContactType           $byContact
     *
     * @return array | null
     */
    public function updateUserSetting(
        User $user,
        UserSetting $userSetting,
        UpdateUserSettingData $updateUserSettingData,
        ContactType $byContact
    ): ?array {
        $this->facade->updateUserSettings($user, $userSetting, $updateUserSettingData->getValue(), $byContact);

        return null;
    }

}
