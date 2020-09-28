<?php

namespace SRC\Domain\Contact;

class Contact
{
    private string $phone;

    /**
     * Contact constructor.
     * @param string $phone
     */
    public function __construct(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return str_replace(['(', ')', ' ', '-'], '', $this->phone);
    }
}