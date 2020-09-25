<?php

namespace SRC\Domain\Contact\Interfaces;

interface DeleteService
{
    public function delete(int $id);
}