<?php

namespace SRC\Domain\Contact\Interfaces;

interface FindContactsByEstablishmentRepository
{
    public function findByEstablishment(int $id): array;
}