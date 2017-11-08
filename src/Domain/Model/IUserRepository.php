<?php

namespace Wphp\Domain\Model;

interface IUserRepository
{
    public function login(User $userId);

    public function add(User $user);
}
