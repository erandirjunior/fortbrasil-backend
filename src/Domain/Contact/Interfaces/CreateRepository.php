<?php

namespace SRC\Domain\Contact\Interfaces;

use SRC\Domain\Contact\Contact;

interface CreateRepository
{
    public function create(Contact $contact, int $establishmentId): int;
}