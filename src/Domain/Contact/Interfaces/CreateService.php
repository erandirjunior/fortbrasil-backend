<?php

namespace SRC\Domain\Contact\Interfaces;

interface CreateService
{
    public function run(array $contacts, int $establishmentId): int;
}