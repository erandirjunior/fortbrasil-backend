<?php

namespace SRC\Domain\Contact\Interfaces;

interface DeleteRepository
{
    public function delete(int $id);
}