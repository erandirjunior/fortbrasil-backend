<?php

namespace SRC\Domain\Establishment;

use SRC\Domain\Establishment\Interfaces\FindRepository;
use SRC\Domain\Establishment\Interfaces\InputBoundery;
use SRC\Domain\Establishment\Interfaces\InputSearchBoundery;

class Find
{
    private FindRepository $repository;

    public function __construct(
        FindRepository $findRepository
    )
    {
        $this->repository = $findRepository;
    }

    public function find(InputSearchBoundery $inputSearchBoundery)
    {
        return $this->repository->find($inputSearchBoundery);
    }
}