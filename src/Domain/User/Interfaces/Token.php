<?php

namespace SRC\Domain\User\Interfaces;

interface Token
{
    public function encode($data);
}