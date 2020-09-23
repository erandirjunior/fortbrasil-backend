<?php

namespace SRC\Domain\User\Interfaces;

interface ValidateDataUpdate
{
    public function validateUpdateData(UserInput $userInput): bool;

    public function getErrors(): array;
}