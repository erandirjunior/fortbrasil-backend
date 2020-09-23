<?php

namespace SRC\Domain\User\Interfaces;

interface UserInput
{
    public function getName(): string;

    public function getEmail(): string;

    public function getPassword(): string;
}