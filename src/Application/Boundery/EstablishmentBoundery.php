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

    private $complement;

    /**
     * EstablishmentBoundery constructor.
     * @param $name
     * @param $zipCode
     * @param $street
     * @param $number
     * @param $city
     * @param $state
     * @param $complement
     */
    public function __construct($name, $zipCode,  $state, $city, $street, $number, $complement)
    {
        $this->name = $name;
        $this->zipCode = $zipCode;
        $this->state = $state;
        $this->city = $city;
        $this->street = $street;
        $this->number = $number;
        $this->complement = $complement;
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