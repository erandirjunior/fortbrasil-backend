<?php

namespace SRC\Domain\Establishment\Interfaces;

interface CreateRepository
{
    public function create(InputBoundery $inputBoundery);
}