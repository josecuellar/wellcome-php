<?php

namespace Wphp\Infrastructure\Persistence\InMemory;

use Wphp\Domain\Model\IUserRepository;
use Wphp\Domain\Model\User;

class InMemoryUserRepository implements IUserRepository
{
    private $users = array();

    public function login($email, $password): bool
    {
        if (!isset($this->users[$email])) 
        {
            return false;
        }

        return ($this->users[$email]->password() == $password);
    }

    public function register(User $user)
    {
        $this->users[$user->email()] = $user;
    }

    public function remove(User $user)
    {
        unset($this->users[$user->email()]);
    }

    public function exists(User $user): bool
    {
        if (isset($this->users[$user->email()]))
        {
            return true;
        }

        return false;
    }
    
    public function get($email): User
    {
        return $this->users[$email];
    }
}
