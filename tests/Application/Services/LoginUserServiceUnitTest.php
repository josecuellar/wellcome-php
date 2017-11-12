<?php

namespace Wphp\Application\Services;

use Wphp\Domain\Model\IUserRepository;
use Wphp\Application\Services\LoginUserService;

class LoginUserServiceUnitTest extends \PHPUnit_Framework_TestCase
{

    private $mockRepository;
    private $service;
    
    public function setUp()
    {
        $this->mockRepository = $this->createMock(IUserRepository::class);
        $this->service = new LoginUserService($this->mockRepository);
    }

    /**
     * @test
     * @expectedException \Wphp\Domain\Model\InvalidLoginException
     */
    public function throwExceptionWhenInvalidLogin()
    {
        $this->mockRepository
                ->method('login')
                ->willReturn(false);
        
        $this->mockRepository
                ->expects($this->once())
                ->method('login');

        $this->service->execute('contacto@josecuellar.net','josecuellar');
    }
    
    /**
     * @test
     */
    public function mustLoginUserWhenExistUserCorrectlyCallingRepository()
    {
        $this->mockRepository
                ->method('login')
                ->willReturn(true);
        
        $this->mockRepository
                ->expects($this->once())
                ->method('login');

        $this->mockRepository
                ->expects($this->once())
                ->method('get');
        
        $this->service->execute('contacto@josecuellar.net','josecuellar');
    }    
}
