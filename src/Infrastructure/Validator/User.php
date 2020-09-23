<?php

namespace SRC\Infrastructure\Validator;

use SRC\Domain\User\Interfaces\UserInput;
use SRC\Domain\User\Interfaces\ValidateDataCreation;
use SRC\Domain\User\Interfaces\ValidateDataUpdate;

class User implements
    ValidateDataCreation,
    ValidateDataUpdate
{
    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    private function nameIsEmpty($name)
    {
        if (empty($name)) {
            $this->errors[] = 'Campo nome não pode ser vazio!';
        }
    }

    private function emailIsEmpty($email)
    {
        if (empty($email)) {
            $this->errors[] = 'Campo e-mail não pode ser vazio!';
        }
    }

    private function passwordIsEmpty($password)
    {
        if (empty($password)) {
            $this->errors[] = 'Campo senha não pode ser vazio!';
        }
    }

    private function passwordHasAcceptableLength($password)
    {
        if (!empty($password) && strlen($password) > 6) {
            $this->errors[] = 'Tamanho mínimo da senha são de 6 caracteres!';
        }
    }

    public function validate(UserInput $userInput): bool
    {
        $this->nameIsEmpty($userInput->getName());
        $this->emailIsEmpty($userInput->getEmail());
        $this->passwordIsEmpty($userInput->getPassword());
        $this->passwordHasAcceptableLength($userInput->getPassword());

        return !!$this->errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function validateUpdateData(UserInput $userInput): bool
    {
        $this->nameIsEmpty($userInput->getName());
        $this->emailIsEmpty($userInput->getEmail());
        $this->passwordHasAcceptableLength($userInput->getPassword());

        return !!$this->errors;
    }
}