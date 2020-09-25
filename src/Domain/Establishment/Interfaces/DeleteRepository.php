<?php

namespace SRC\Domain\Establishment\Interfaces;

interface DeleteRepository
{
    public function delete(int $id);
}