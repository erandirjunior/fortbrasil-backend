<?php

namespace SRC\Domain\Contact;

use SRC\Domain\Contact\Interfaces\CreateRepository;

class Create
{
    private CreateRepository $repository;

    public function __construct(
        CreateRepository $createRepository
    )
    {
        $this->repository = $createRepository;
    }

    public function create(array $contact, int $establishmentId)
    {
        if ($this->checkIfCanSaveContact($contact)) {
            return $this->save($contact['phone'], $establishmentId);
        }
    }

    private function checkIfCanSaveContact($contact)
    {
        if (empty($contact['phone'])) {
            return false;
        }

        return true;
    }

    private function save($phone, $establishmentId)
    {
        $contact = new Contact($phone);

        return $this->repository->create($contact, $establishmentId);
    }
}