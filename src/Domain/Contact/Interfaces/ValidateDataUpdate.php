<?php

namespace SRC\Domain\Contact\Interfaces;

interface ValidateDataUpdate
{
    public function validateUpdateData(UserInput $userInput): bool;

    public function getErrors(): array;
}