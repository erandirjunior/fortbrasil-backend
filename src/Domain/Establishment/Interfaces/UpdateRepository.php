<?php

namespace SRC\Domain\Establishment\Interfaces;

interface UpdateRepository
{
    public function update(InputBoundery $inputBoundery, int $id): bool;
}