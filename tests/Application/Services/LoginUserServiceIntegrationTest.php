<?php

namespace Wphp\Application\Services;

use Wphp\Domain\Model\User;
use Wphp\Application\Services\RegisterUserService;
use Wphp\Infrastructure\Persistence\InMemory\InMemoryUserRepository;

class LoginUserServiceIntegrationTest extends \PHPUnit_Framework_TestCase
{

    private $repository;
    private $mockValidUser;
    private $mockNotExistUser;
    private $service;
    
    public function setUp()
    {
        $this->repository = new InMemoryUserRepository();
        
        $this->service = new LoginUserService($this->repository);

        $this->mockValidUser = new User('contacto@josecuellar.net', 'josecuellar');
        $this->mockNotExistUser = new User('contacto@josecuellar2.net', 'josecuellar');

        $this->repository->register($this->mockValidUser);
        $this->repository->remove($this->mockNotExistUser);
    }

    /**
     * @test
     * @expectedException \Wphp\Domain\Model\InvalidLoginException
     */
    public function throwExceptionWhenInvalidLogin()
    {
        $this->service->execute($this->mockNotExistUser->email(), $this->mockNotExistUser->password());
    }

    /**
     * @test
     */
    public function getValidUserDataLoggedWhenIsValidLogin()
    {
        $user = $this->service->execute($this->mockValidUser->email(), $this->mockValidUser->password());

        $this->assertInstanceOf(
            User::class,
            $user
        );

        $this->assertEquals(
            $user->email(),
            $this->mockValidUser->email()
        );

        $this->assertEquals(
            $user->password(),
            $this->mockValidUser->password()
        );
    }
}
