<?php

namespace SRC\Application\Boundery;

use SRC\Domain\Establishment\Interfaces\InputSearchBoundery;

class EstablishmentSearchBoundery implements InputSearchBoundery
{
    private $name;

    private $city;

    private $state;

    private $street;

    /**
     * EstablishmentSearchBoundery constructor.
     * @param $name
     * @param $street
     * @param $city
     * @param $state
     */
    public function __construct($name, $state, $city, $street)
    {
        $this->name = $name;
        $this->state = $state;
        $this->city = $city;
        $this->street = $street;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStreet(): string
    {
        return $this->street;
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