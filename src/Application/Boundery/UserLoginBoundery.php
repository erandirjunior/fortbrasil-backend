<?php

namespace SRC\Application\Boundery;

use SRC\Domain\Exception\ValidateException;
use SRC\Domain\User\Interfaces\UserLoginInput;

class UserLoginBoundery implements UserLoginInput
{
    private $email;

    private $password;

    private ValidateException $validateException;

    /**
     * UserBoundery constructor.
     * @param $name
     * @param $email
     * @param $password
     */
    public function __construct(
        ValidateException $validateException,
        $email,
        $password
    )
    {
        $this->validateException = $validateException;
        $this->setEmail($email);
        $this->setPassword($password);
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
        if (empty($email)) {
            $this->validateException->setMessage('Campo email não pode ser vazio!');

            throw $this->validateException;
        }

        $this->email = $email;
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
        if (empty($password)) {
            $this->validateException->setMessage('Campo senha não pode ser vazio!');

            throw $this->validateException;
        }
        $this->password = $password;
    }
}