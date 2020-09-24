<?php

namespace SRC\Domain\User\Interfaces;

interface UpdateRepository
{
    public function updateAll(UserInput $userInput, int $id): bool;

    public function updateNameAndEmail(UserInput $userInput, int $id): bool;

    public function checkIfHasCanUseEmail(string $email, int $id): bool;
}