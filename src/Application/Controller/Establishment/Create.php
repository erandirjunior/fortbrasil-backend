<?php

namespace SRC\Application\Controller\Establishment;

use SRC\Application\Boundery\EstablishmentBoundery;
use SRC\Application\Exception\ServerException;
use SRC\Application\Exception\ValidateException;
use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\Contact;
use SRC\Application\Repository\Establishment;
use SRC\Domain\Establishment\Interfaces\Validator;

class Create
{
    private Establishment $repository;

    private Contact $contactRepository;

    private Validator $validator;

    private JsonPresenter $presenter;

    /**
     * Create constructor.
     * @param Establishment $repository
     * @param Validator $validator
     */
    public function __construct(
        Establishment $repository,
        Validator $validator,
        JsonPresenter $jsonPresenter,
        Contact $contactRepository
    )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->presenter = $jsonPresenter;
        $this->contactRepository = $contactRepository;
    }

    public function run(array $data)
    {
        $validateException  = new ValidateException();
        $serverException    = new ServerException();

        try {
            $inputBoundery = $this->createEstablishmentBoundery($data);

            $domain = new \SRC\Domain\Establishment\Create(
                $this->repository,
                $this->validator,
                $serverException,
                $validateException
            );

            $id = $domain->create($inputBoundery);

            $this->saveContacts($data, $id);

            echo $this->presenter->json(201);
        } catch (\Exception $exception) {
            echo $this->presenter->json($exception->getCode(), $exception->getMessage());
        }
    }

    /**
     * @param $data
     * @return EstablishmentBoundery
     */
    private function createEstablishmentBoundery($data): EstablishmentBoundery
    {
        return new EstablishmentBoundery(
            $data['name'],
            $data['zipCode'],
            $data['state'],
            $data['city'],
            $data['street'],
            $data['number']
        );
    }

    /**
     * @param array $data
     * @param $id
     */
    protected function saveContacts(array $data, $id): void
    {
        if (!empty($data['contacts'])) {
            $contactCreate = new \SRC\Application\Controller\Contact\Create(
                $this->contactRepository
            );

            foreach ($data['contacts'] as $contact) {
                $contactCreate->run($contact, $id);
            }
        }
    }
}