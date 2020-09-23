<?php

namespace SRC\Domain\User;

use SRC\Domain\User\Interfaces\FindRepository;

class FindById
{
    private FindRepository $repository;

    public function __construct(
        FindRepository $findRepository
    )
    {
        $this->repository = $findRepository;
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }
}