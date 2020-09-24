<?php

namespace SRC\Domain\User;

use SRC\Domain\User\Interfaces\DeleteRepository;

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