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
            return $this->save($contact['type'], $contact['phone'], $establishmentId);
        }
    }

    private function checkIfCanSaveContact($contact)
    {
        if (empty($contact['type']) || empty($contact['phone'])) {
            return false;
        }

        return true;
    }

    private function save($type, $phone, $establishmentId)
    {
        $contact = new Contact($type, $phone);

        return $this->repository->create($contact, $establishmentId);
    }
}