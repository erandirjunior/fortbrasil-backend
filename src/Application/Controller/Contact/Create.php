<?php

namespace SRC\Application\Controller\Contact;

use SRC\Application\Repository\Contact;
use SRC\Domain\Contact\Interfaces\CreateService;

class Create implements CreateService
{
    private Contact $repository;

    public function __construct(
        Contact $repository
    )
    {
        $this->repository = $repository;
    }

    public function run(array $contacts, int $establishmentId): int
    {
        $domain = new \SRC\Domain\Contact\Create(
            $this->repository
        );

        return $domain->create($contacts, $establishmentId);
    }
}