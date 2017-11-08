<?php

namespace Lw\Infrastructure\Persistence\InMemory\User;

use Wphp\Domain\Model\IUserRepository;
use Wphp\Domain\Model\User;

class InMemoryUserRepository implements IUserRepository
{
    /**
     * @var User[]
     */
    private $users = array();

    /**
     * {@inheritdoc}
     */
    public function login(User $user)
    {
        if (!isset($this->users[$user->email()])) {
            return;
        }

        return $this->users[$user->email()];
    }

    /**
     * {@inheritdoc}
     */
    public function add(User $user)
    {
        $this->users[$user->email()] = $user;
    }
}
