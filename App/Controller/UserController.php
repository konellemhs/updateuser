<?php

namespace App\Controller;

use App\DTO\UpdateUserSettingData;
use App\Entity\User;
use App\Entity\UserSetting;
use App\Enum\ContactType;
use App\Exception\ConfirmationCodeInvalidException;
use App\Exception\EntityNotFoundException;
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
     * Получение активных настроек пользователя, запрос get /user/{id}/setting
     *
     * @param User $user
     *
     * @return array
     */
    public function getUserSettings(User $user): array
    {
        return $user->getActiveSettings();
    }

    /**
     * Запрос создание код подтверждения смены настроек, запрос post /user/{id}/setting/{id}/code
     *
     * @param User                  $user
     * @param UserSetting           $userSetting
     * @param UpdateUserSettingData $updateUserSettingData
     * @param ContactType           $byContact
     *
     * @return array | null
     */
    public function createConfirmationCode(
        User $user,
        UserSetting $userSetting,
        UpdateUserSettingData $updateUserSettingData,
        ContactType $byContact
    ): ?array {
        $this->facade->createConfirmationCode($user, $userSetting, $updateUserSettingData->getValue(), $byContact);

        return null;
    }

    /**
     * Запрос подтверждения смены настроек, запрос put /user/{id}/setting/{id}/code/{code_value}
     *
     * @param User        $user
     * @param UserSetting $userSetting
     * @param string      $codeValue
     *
     * @return User
     */
    public function updateUserSettings(
        User $user,
        UserSetting $userSetting,
        string $codeValue,
    ): User {
        try {
            $this->facade->updateUserSettings($user, $userSetting, $codeValue);
        } catch (ConfirmationCodeInvalidException $e) {
            // 400, с кодом ошибки код невалидный
        } catch (EntityNotFoundException $e) {
            // 404 с кодом код не найден
        }

        return $user;
    }
}
