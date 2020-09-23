<?php

namespace SRC\Domain\User\Interfaces;

interface Validator
{
    public function validate(UserInput $userInput): bool;

    public function getErrors(): array;
}