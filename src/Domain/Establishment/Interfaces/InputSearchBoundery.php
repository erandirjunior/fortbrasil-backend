<?php

namespace SRC\Domain\Establishment\Interfaces;

interface InputSearchBoundery
{
    public function getName(): string;

    public function getStreet(): string;

    public function getCity(): string;

    public function getState(): string;
}