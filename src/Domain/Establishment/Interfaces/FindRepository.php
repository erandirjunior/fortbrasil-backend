<?php

namespace SRC\Domain\Establishment\Interfaces;

interface FindRepository
{
    public function find(InputSearchBoundery $inputSearchBoundery): array;
}