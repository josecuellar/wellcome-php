<?php

namespace Wphp\Domain\Model;

interface IUserRepository
{
    public function login($email, $password): bool;

    public function get($email): User;

    public function register(User $user);

    public function remove(User $user);

    public function exists(User $user): bool;
}
