<?php

namespace App\Entity;

use App\Enum\ContactType;

final class User
{
    /**
     * автогенерируемый
     *
     * @var string
     */
    private string $uid;

    /**
     * Связь ManyToOne
     *
     * @var array<UserSetting>
     */
    private array $settings;

    /**
     * Связь ManyToOne
     *
     * @var array<UserContact>
     */
    private array $contacts;

    /**
     * @param UserSetting[] | array $settings
     * @param UserContact[] | array $contacts
     */
    public function __construct(array $settings, array $contacts)
    {
        $this->settings = $settings;
        $this->contacts = $contacts;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @return array<UserSetting>
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @return array
     */
    public function getActiveSettings(): array
    {
        return array_filter(
            $this->settings,
            static fn(UserSetting $userSetting): bool => $userSetting->isActive(),
        );
    }

    /**
     * @return array<UserContact>
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * @param ContactType $type
     *
     * @return UserContact | null
     */
    public function getContactByType(ContactType $type): ?UserContact
    {
        $filtered = array_filter(
            $this->contacts,
            static fn(UserContact $contact): bool => $contact->getType() === $type,
        );

        return empty($filtered) ? null : current($filtered);
    }
}
