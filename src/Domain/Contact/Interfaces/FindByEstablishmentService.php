<?php

namespace SRC\Domain\Contact\Interfaces;

interface FindByEstablishmentService
{
    public function run(int $id): array;
}