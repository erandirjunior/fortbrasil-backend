<?php

namespace SRC\Domain\Contact;

class Contact
{
    private int $type;

    private string $phone;

    /**
     * Contact constructor.
     * @param int $type
     * @param string $phone
     */
    public function __construct(int $type, string $phone)
    {
        $this->type = $type;
        $this->phone = $phone;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return str_replace(['(', ')', ' ', '-'], '', $this->phone);
    }
}