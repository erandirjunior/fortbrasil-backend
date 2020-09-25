<?php

namespace SRC\Domain\Contact;

use SRC\Domain\Contact\Interfaces\FindRepository;

class Find
{
    private FindRepository $repository;

    /**
     * FindByEstablishment constructor.
     * @param FindRepository $repository
     */
    public function __construct(FindRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find(int $establishmentId)
    {
        return $this->repository->find($id);
    }
}