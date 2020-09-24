<?php

namespace SRC\Domain\User\Interfaces;

interface DeleteRepository
{
    public function delete(int $id);
}