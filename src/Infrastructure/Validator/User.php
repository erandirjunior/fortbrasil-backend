<?php

namespace SRC\Infrastructure\Validator;

use SRC\Domain\User\Interfaces\UserInput;

class User implements \SRC\Domain\User\Interfaces\Validator
{
    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function validate(UserInput $userInput): bool
    {
        if (empty($userInput->getName())) {
            $this->errors[] = 'Campo nome não pode ser vazio!';
        }

        if (empty($userInput->getEmail())) {
            $this->errors[] = 'Campo e-mail não pode ser vazio!';
        }

        if (empty($userInput->getPassword())) {
            $this->errors[] = 'Campo senha não pode ser vazio!';
        }

        return !!$this->errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}