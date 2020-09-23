<?php

namespace SRC\Domain\User\Interfaces;

interface FindRepository
{
    public function find(int $id): array;
}