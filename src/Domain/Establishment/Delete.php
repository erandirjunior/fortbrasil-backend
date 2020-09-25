<?php

namespace SRC\Domain\Establishment;

use SRC\Domain\Establishment\Interfaces\DeleteRepository;

class Delete
{
    private DeleteRepository $repository;

    public function __construct(
        DeleteRepository $deleteRepository
    )
    {
        $this->repository = $deleteRepository;
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}