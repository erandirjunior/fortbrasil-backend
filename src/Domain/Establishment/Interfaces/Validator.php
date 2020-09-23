<?php

namespace SRC\Domain\Establishment\Interfaces;

interface Validator
{
    public function validate(InputBoundery $inputBoundery): bool ;

    public function getErrors(): array;
}