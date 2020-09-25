<?php

namespace SRC\Domain\Contact\Interfaces;

interface UpdateRepository
{
    public function update(\SRC\Domain\Contact\Contact $contact, int $id);
}