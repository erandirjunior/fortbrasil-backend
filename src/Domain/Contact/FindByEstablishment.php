<?php

namespace SRC\Domain\Contact;

use SRC\Domain\Contact\Interfaces\FindContactsByEstablishmentRepository;

class FindByEstablishment
{
    private FindContactsByEstablishmentRepository $repository;

    /**
     * FindByEstablishment constructor.
     * @param FindContactsByEstablishmentRepository $repository
     */
    public function __construct(FindContactsByEstablishmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find(int $establishmentId)
    {
        return $this->repository->findByEstablishment($establishmentId);
    }
}