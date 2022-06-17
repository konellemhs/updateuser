<?php

namespace App\Facade;

use App\DTO\Template\ConfirmationCodeTemplate\ConfirmationCodeTemplateData;
use App\Entity\ConfirmationCode;
use App\Entity\User;
use App\Entity\UserContact;
use App\Entity\UserSetting;
use App\Enum\ContactType;
use App\Exception\ConfirmationCodeInvalidException;
use App\Exception\EntityNotFoundException;
use App\Infrastructure\Transport\TransportFactory;
use App\Repository\UserSettingRepositoryInterface;
use App\Service\ConfirmationCodeService;
use App\Service\UserSettingService;
use Exception;
use InvalidArgumentException;
use Throwable;

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
    private UserSettingService $userSettingService;

    /**
     * @var UserSettingRepositoryInterface
     */
    private UserSettingRepositoryInterface $userSettingsRepository;

    /**
     * @param ConfirmationCodeService        $confirmationCodeService
     * @param TransportFactory               $transportFactory
     * @param UserSettingRepositoryInterface $userSettingRepository
     * @param UserSettingService             $settingService
     */
    public function __construct(
        ConfirmationCodeService $confirmationCodeService,
        TransportFactory $transportFactory,
        UserSettingRepositoryInterface $userSettingRepository,
        UserSettingService $settingService
    ) {
        $this->confirmationCodeService = $confirmationCodeService;
        $this->transportFactory = $transportFactory;
        $this->userSettingService = $settingService;
        $this->userSettingsRepository = $userSettingRepository;
    }

    /**
     * @param User        $user
     * @param UserSetting $userSetting
     * @param string      $newValue
     * @param ContactType $byContact
     *
     * @return void
     */
    public function createConfirmationCode(User $user, UserSetting $userSetting, string $newValue, ContactType $byContact): void
    {
        $confirmationCode = $this->confirmationCodeService->create();

        $userContact = $user->getContactByType($byContact);

        if (is_null($userContact)) {
            throw new InvalidArgumentException(
                sprintf('У пользователя %s нет контакта типа %s', $user->getUid(), $byContact->getValue())
            );
        }

        $this->sendConfirmationCode($userContact, $confirmationCode);

        $this->userSettingService->createInactiveUserSetting(
            $user,
            $userSetting->getSetting(),
            $newValue,
            $confirmationCode,
        );
    }

    /**
     * @param User        $user
     * @param UserSetting $userSetting
     * @param string      $codeValue
     *
     * @return void
     *
     * @throws ConfirmationCodeInvalidException
     * @throws EntityNotFoundException
     */
    public function updateUserSettings(User $user, UserSetting $userSetting, string $codeValue): void
    {
        $newUserSetting = $this->userSettingsRepository->getInactiveUserSetting(
            $user->getUid(),
            $userSetting->getSetting()->getId()
        );

        $newUserSettingCode = $newUserSetting->getCode();

        if (is_null($newUserSettingCode)) {
            throw new InvalidArgumentException('Код подтверждения не был отправлен');
        }

        // Валидация
        $this->confirmationCodeService->validateCode($newUserSettingCode, $codeValue);

        try {
            //тут начало транзакции

            $this->userSettingService->deactivateUserSetting($userSetting);
            $this->userSettingService->activateUserSetting($newUserSetting);
            $this->confirmationCodeService->deactivateCode($newUserSettingCode);

            // тут коммит
        } catch (Throwable $exception) {
            // тут роллбэк
            throw new Exception($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param UserContact      $contact
     * @param ConfirmationCode $code
     *
     * @return void
     */
    private function sendConfirmationCode(UserContact $contact, ConfirmationCode $code): void
    {
        $transport = $this->transportFactory->getTransportByContactType($contact->getType());

        $transport->sendMessage(
            $contact->getIdentifier(),
            new ConfirmationCodeTemplateData($code->getValue())
        );
    }
}
