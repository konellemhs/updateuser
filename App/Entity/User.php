<?php

namespace App\Entity;

final class User
{
    /**
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
     * @return array<UserContact>
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }
}
