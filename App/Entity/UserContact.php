<?php

namespace App\Entity;

use App\Enum\ContactType;

/**
 * Контакт пользователя
 */
final class UserContact
{
    /**
     * @var int
     */
    private int $id;

    /**
     * Связь ManyToOne
     *
     * @var User
     */
    private User $user;

    /**
     * @var ContactType
     */
    private ContactType $type;

    /**
     * Идентификатор пользователя в контакте
     *
     * @var string
     */
    private string $identifier;

    /**
     * @param User        $user
     * @param ContactType $type
     * @param string      $identifier
     */
    public function __construct(User $user, ContactType $type, string $identifier)
    {
        $this->user = $user;
        $this->type = $type;
        $this->identifier = $identifier;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return ContactType
     */
    public function getType(): ContactType
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
