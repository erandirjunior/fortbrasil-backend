<?php

namespace SRC\Application\Boundery;

use SRC\Domain\Establishment\Interfaces\InputBoundery;
use SRC\Domain\Establishment\Interfaces\InputSearchBoundery;

class EstablishmentBoundery implements
    InputBoundery,
    InputSearchBoundery
{
    private $name;

    private $zipCode;

    private $city;

    private $state;

    private $street;

    private $number;

    /**
     * EstablishmentBoundery constructor.
     * @param $name
     * @param $zipCode
     * @param $street
     * @param $number
     * @param $city
     * @param $state
     */
    public function __construct($name, $zipCode,  $state, $city, $street, $number)
    {
        $this->name = $name;
        $this->zipCode = $zipCode;
        $this->state = $state;
        $this->city = $city;
        $this->street = $street;
        $this->number = $number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getZipCode(): string
    {
        return str_replace('-', '', $this->zipCode);
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getNumber(): int
    {
        return $this->number;
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