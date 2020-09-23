<?php

namespace SRC\Domain\User\Interfaces;

interface UserUpdateInput extends UserInput
{
    public function setPassword(string $password): string;
}