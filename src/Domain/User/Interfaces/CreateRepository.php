<?php

namespace SRC\Domain\User\Interfaces;

interface CreateRepository
{
    public function create(UserInput $userInput): bool;

    public function findUserByEmail(string $email): array;
}