<?php

namespace SRC\Domain\Contact\Interfaces;

interface FindRepository
{
    public function find(int $id): array;
}