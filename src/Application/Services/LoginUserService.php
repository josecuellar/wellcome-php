<?php

namespace Wphp\Application\Services;

use Wphp\Domain\Model\IUserRepository;
use Wphp\Domain\Model\User;
use Wphp\Domain\Model\InvalidLoginException;

class LoginUserService
{
    private $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($email, $password): User
    {
        if (!$this->repository->login($email, $password))
        {
            throw(new InvalidLoginException());
        }
        
        return $this->repository->get($email);
    }
}
