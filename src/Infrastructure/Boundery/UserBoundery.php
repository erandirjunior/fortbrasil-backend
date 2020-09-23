<?php

namespace SRC\Infrastructure\Boundery;

use SRC\Domain\User\Interfaces\UserInput;

class UserBoundery implements UserInput
{
    private $name;

    private $email;

    private $password;

    /**
     * UserBoundery constructor.
     * @param $name
     * @param $email
     * @param $password
     */
    public function __construct($name, $email, $password)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
    }


    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name ? $name : '';
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email ? $email : '';
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password ? $password : '';
    }
}