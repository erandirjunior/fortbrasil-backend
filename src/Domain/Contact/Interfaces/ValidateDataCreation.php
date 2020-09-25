<?php

namespace SRC\Domain\Contact\Interfaces;

interface ValidateDataCreation
{
    public function validate(UserInput $userInput): bool;

    public function getErrors(): array;
}