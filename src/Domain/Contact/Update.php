<?php

namespace SRC\Domain\Contact;

use SRC\Domain\Contact\Interfaces\CreateService;
use SRC\Domain\Contact\Interfaces\DeleteService;
use SRC\Domain\Contact\Interfaces\FindByEstablishmentService;
use SRC\Domain\Contact\Interfaces\UpdateRepository;

class Update
{
    private UpdateRepository $repository;
    private DeleteService $deleteService;
    private CreateService $createService;
    private FindByEstablishmentService $findByEstablishService;
    private array $ids;

    /**
     * Delete constructor.
     * @param UpdateRepository $repository
     */
    public function __construct(
        UpdateRepository $repository,
        DeleteService $deleteService,
        CreateService $createService,
        FindByEstablishmentService $findByEstablishService
    )
    {
        $this->repository = $repository;
        $this->deleteService = $deleteService;
        $this->createService = $createService;
        $this->findByEstablishService = $findByEstablishService;
        $this->ids = [];
    }

    public function update(array $contacts,  int $establishmentId)
    {
        foreach ($contacts as $contact) {
            if (empty($contact['id'])) {
                $this->ids[] = $this->createService->run($contact, $establishmentId);

                continue;
            }

            $this->ids[] = $contact['id'];
            $this->saveContactData($contact);
        }

        $data = $this->findByEstablishService->run($establishmentId);
        foreach ($data as $contact) {
            if (!in_array($contact['id'], $this->ids)) {
                $this->deleteService->delete($contact['id']);
            }
        }
    }

    public function saveContactData(array $contact)
    {
        $boundery = new Contact($contact['type'], $contact['phone']);

        $this->repository->update($boundery, $contact['id']);
    }
}