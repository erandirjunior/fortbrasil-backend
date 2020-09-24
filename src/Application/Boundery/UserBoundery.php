<?php

namespace SRC\Application\Boundery;

use SRC\Domain\Exception\ValidateException;
use SRC\Domain\User\Interfaces\UserInput;
use SRC\Domain\User\Interfaces\UserUpdateInput;

class UserBoundery implements UserInput, UserUpdateInput
{
    private $name;

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
        $name,
        $email,
        $password
    )
    {
        $this->validateException = $validateException;
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
        if (empty($name)) {
            $this->validateException->setMessage('Campo nome não pode ser vazio!');

            throw $this->validateException;
        }

        $this->name = $name;
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
        $this->password = $password;
    }

    public function getPasswordEncrypted()
    {
        return password_hash($this->password, PASSWORD_ARGON2I);
    }
}