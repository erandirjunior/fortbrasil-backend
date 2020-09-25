<?php

namespace SRC\Application\Controller\Contact;

use SRC\Application\Repository\Contact;
use SRC\Domain\Contact\Interfaces\FindByEstablishmentService;

class FindByEstablishment implements FindByEstablishmentService
{
    private Contact $repository;

    public function __construct(
        Contact $repository
    )
    {
        $this->repository = $repository;
    }

    public function run(int $establishmentId): array
    {
        $domain = new \SRC\Domain\Contact\FindByEstablishment(
            $this->repository
        );

        return $domain->find($establishmentId);
    }
}