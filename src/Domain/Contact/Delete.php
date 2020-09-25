<?php

namespace SRC\Domain\Contact;

use SRC\Domain\Contact\Interfaces\DeleteRepository;

class Delete
{
    private DeleteRepository $repository;

    /**
     * Delete constructor.
     * @param DeleteRepository $repository
     */
    public function __construct(DeleteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete(string $id)
    {
        $this->repository->delete($id);
    }
}