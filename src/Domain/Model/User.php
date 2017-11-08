<?php

namespace Wphp\Domain\Model;

class User
{
    const MIN_LENGTH_PASSWORD = 5;
   
    private $email;
    
    private $password;

    public function __construct(string $email, string $password)
    {
        $this->setEmail($email);
        $this->changePassword($password);
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
    
    public function changePassword(string $password)
    {
        $password = trim($password);
        
        if (count_chars($password) <= User::MIN_LENGTH_PASSWORD || $password=='') {
            throw new \InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid password. Need more than '.User::MIN_LENGTH_PASSWORD.' characters',
                    $password
                )
            );
        }

        $this->password = $password;
    }

    public function setEmail(string $email)
    {
        $email = strtolower(trim($email));
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == '') {
            throw new \InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid email address',
                    $email
                )
            );
        }
        
        $this->email = $email;
    }
}