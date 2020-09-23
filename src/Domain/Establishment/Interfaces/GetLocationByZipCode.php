<?php

namespace SRC\Domain\Establishment\Interfaces;

interface GetLocationByZipCode
{
    public function getLocation(string $zipCode): array ;
}