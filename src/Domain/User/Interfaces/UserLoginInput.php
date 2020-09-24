<?php

namespace SRC\Domain\User\Interfaces;

interface UserLoginInput
{
    public function getEmail(): string;

    public function getPassword(): string;
}