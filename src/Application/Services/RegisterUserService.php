<?php

namespace Wphp\Application\Services;

use Wphp\Domain\Model\IUserRepository;
use Wphp\Domain\Model\User;
use Wphp\Domain\Model\UserAlreadyExistsException;

class RegisterUserService
{
    private $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($email, $password)
    {
        $userToRegister = new User($email, $password);
        
        if ($this->repository->exists($userToRegister))
        {
            throw(new UserAlreadyExistsException());
        }
        
        return $this->repository->register($userToRegister);
    }
}
