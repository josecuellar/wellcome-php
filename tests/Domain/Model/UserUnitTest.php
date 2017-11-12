<?php

namespace Wphp\Domain\Model;

/**
 * @covers User
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function emptyEmailShouldThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        new User('', 'testpasswordvalid');
    }

    /**
     * @test
     */
    public function invalidEmailShouldThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        new User('invalid@email', 'testpasswordvalid');
    }
    
    /**
     * @test
     */
    public function emptyPasswordShouldThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        new User('test@validemail.com', '');
    }

    /**
     * @test
     */
    public function invalidPasswordShouldThrowException()
    {
        $this->expectException(\InvalidArgumentException::class);

        new User('test@validemail.com', '');
    }

    private function createUserWithEmail($email): User
    {
        return new User($email, 'testpasswordvalid');
    }

    /**
     * @test
     * @dataProvider sanitizedEmails
     */
    public function itShouldSanitizeEmail($email, $expectedEmail)
    {
        $user = $this->createUserWithEmail($email);

        $this->assertEquals($expectedEmail, $user->email());
    }

    public function sanitizedEmails()
    {
        return [
            ['user@example.com', 'user@example.com'],
            ['USER@EXAMPLE.COM', 'user@example.com'],
            ['   user@example.com ', 'user@example.com'],
        ];
    }
}