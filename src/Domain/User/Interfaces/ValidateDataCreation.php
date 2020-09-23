<?php

namespace SRC\Domain\User\Interfaces;

interface ValidateDataCreation
{
    public function validate(UserInput $userInput): bool;

    public function getErrors(): array;
}