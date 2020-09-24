<?php

namespace SRC\Domain\User\Interfaces;

interface FindByEmailRepository
{
    public function findUserByEmail(string $email): array;
}