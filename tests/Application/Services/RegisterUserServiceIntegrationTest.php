<?php

namespace Wphp\Application\Services;

use Wphp\Domain\Model\User;
use Wphp\Application\Services\RegisterUserService;
use Wphp\Infrastructure\Persistence\InMemory\InMemoryUserRepository;

class RegisterUserServiceIntegrationTest extends \PHPUnit_Framework_TestCase
{

    private $repository;
    private $mockValidUser;
    private $mockExistUser;
    private $service;
    
    public function setUp()
    {
        $this->repository = new InMemoryUserRepository();
        
        $this->service = new RegisterUserService($this->repository);

        $this->mockValidUser = new User('contacto@josecuellar.net', 'josecuellar');
        $this->mockExistUser = new User('contacto@josecuellar2.net', 'josecuellar');

        $this->repository->register($this->mockExistUser);
        $this->repository->remove($this->mockValidUser);
    }

    /**
     * @test
     * @expectedException \Wphp\Domain\Model\UserAlreadyExistsException
     */
    public function throwExceptionWhenUserExists()
    {
        $this->service->execute($this->mockExistUser->email(), $this->mockExistUser->password());
    }

    /**
     * @test
     */
    public function mustBeInRepositoryWhenUserIsRegistered()
    {
        $this->service->execute($this->mockValidUser->email(), $this->mockValidUser->password());

        $this->assertTrue(
            $this->repository->exists($this->mockValidUser)
        );
    }
}
