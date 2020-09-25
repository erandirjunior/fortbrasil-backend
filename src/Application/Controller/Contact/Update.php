<?php

namespace SRC\Application\Controller\Contact;

use SRC\Application\Repository\Contact;

class Update
{
    private Contact $repository;

    private \SRC\Domain\Contact\Update $domain;

    public function __construct(
        Contact $repository
    )
    {
        $this->repository = $repository;
    }

    public function run(array $contacts, int $establishmentId)
    {
        $domain = new \SRC\Domain\Contact\Update(
            $this->repository,
            new Delete($this->repository),
            new Create($this->repository),
            new FindByEstablishment($this->repository)
        );

        $domain->update($contacts, $establishmentId);
    }
}