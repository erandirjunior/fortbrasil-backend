<?php

namespace SRC\Domain\Establishment\Interfaces;

interface InputBoundery
{
    public function getName(): string;

    public function getZipCode(): string;

    public function getStreet(): string;

    public function getNumber(): int;

    public function getCity(): string;

    public function getState(): string;
}