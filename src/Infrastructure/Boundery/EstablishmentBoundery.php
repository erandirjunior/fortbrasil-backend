<?php

namespace SRC\Infrastructure\Boundery;

use SRC\Domain\Establishment\Interfaces\InputBoundery;

class EstablishmentBoundery implements InputBoundery
{
    private $name;
    private $zipCode;
    private $street;
    private $number;
    private $complement;
    private $city;
    private $state;

    /**
     * EstablishmentBoundery constructor.
     * @param $name
     * @param $zipCode
     * @param $street
     * @param $number
     * @param $complement
     * @param $city
     * @param $state
     */
    public function __construct($name, $zipCode, $street, $number, $complement, $city, $state)
    {
        $this->name = $name;
        $this->zipCode = $zipCode;
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
        $this->city = $city;
        $this->state = $state;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getComplement(): string
    {
        return $this->complement;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getState(): string
    {
        return $this->state;
    }
}