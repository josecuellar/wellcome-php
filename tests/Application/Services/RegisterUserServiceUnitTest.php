<?php

namespace Wphp\Application\Services;

use Wphp\Domain\Model\User;
use Wphp\Domain\Model\IUserRepository;
use Wphp\Application\Services\RegisterUserService;

class RegisterUserServiceUnitTest extends \PHPUnit_Framework_TestCase
{

    private $mockRepository;
    private $service;
    
    public function setUp()
    {
        $this->mockRepository = $this->createMock(IUserRepository::class);
        $this->service = new RegisterUserService($this->mockRepository);
    }

    /**
     * @test
     * @expectedException \Wphp\Domain\Model\UserAlreadyExistsException
     */
    public function throwExceptionWhenUserExists()
    {
        $this->mockRepository
                ->method('exists')
                ->willReturn(true);
        
        $this->mockRepository
                ->expects($this->once())
                ->method('exists');

        $this->service->execute('contacto@josecuellar.net', 'josecuellar');
    }
    
    /**
     * @test
     */
    public function mustRegisterUserWhenNotExistUserCorrectlyCallingRepository()
    {
        $this->mockRepository
                ->method('exists')
                ->willReturn(false);
        
        $this->mockRepository
                ->expects($this->once())
                ->method('exists');

        $this->mockRepository
                ->expects($this->once())
                ->method('register');
        
        $this->service->execute('contacto@josecuellar.net', 'josecuellar');
    }    
}
