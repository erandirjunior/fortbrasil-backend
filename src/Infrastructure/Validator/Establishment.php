<?php

namespace SRC\Infrastructure\Validator;

use SRC\Domain\Establishment\Interfaces\InputBoundery;
use SRC\Domain\Establishment\Interfaces\Validator;

class Establishment implements Validator
{
    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function validate(InputBoundery $inputBoundery): bool
    {
        if (empty($inputBoundery->getName())) {
            $this->errors[] = 'Campo nome não pode ser vazio!';
        }

        if (empty($inputBoundery->getNumber())) {
            $this->errors[] = 'Campo número não pode ser vazio!';
        }

        if (empty($inputBoundery->getZipCode())) {
            $this->errors[] = 'Campo nome não pode ser vazio!';
        }

        if (empty($inputBoundery->getState())) {
            $this->errors[] = 'Campo nome não pode ser vazio!';
        }

        if (empty($inputBoundery->getCity())) {
            $this->errors[] = 'Campo nome não pode ser vazio!';
        }

        if (empty($inputBoundery->getStreet())) {
            $this->errors[] = 'Campo de endereço não pode ser vazio!';
        }

        return !!$this->errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}