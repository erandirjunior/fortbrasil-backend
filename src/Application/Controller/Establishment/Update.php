<?php

namespace SRC\Application\Controller\Establishment;

use SRC\Application\Boundery\EstablishmentBoundery;
use SRC\Application\Exception\ServerException;
use SRC\Application\Exception\ValidateException;
use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\Contact;
use SRC\Application\Repository\Establishment;
use SRC\Domain\Establishment\Interfaces\Validator;

class Update
{
    private Establishment $repository;

    private Contact $contactRepository;

    private Validator $validator;

    private JsonPresenter $presenter;

    /**
     * Update constructor.
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

    public function run(array $data, int $establishmentId)
    {
        $validateException  = new ValidateException();
        $serverException    = new ServerException();

        try {
            $inputBoundery = $this->createEstablishmentBoundery($data);

            $domain = new \SRC\Domain\Establishment\Update(
                $this->repository,
                $this->validator,
                $serverException,
                $validateException
            );

            $domain->update($inputBoundery, $establishmentId);

            $this->saveContacts($data, $establishmentId);

            echo $this->presenter->json(204);
        } catch (\Exception $exception) {
            echo $this->presenter->json($exception->getCode(), $exception->getMessage());
        }
    }

    /**
     * @param $data
     * @return EstablishmentBoundery
     */
    protected function createEstablishmentBoundery($data): EstablishmentBoundery
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
        $contactUpdate = new \SRC\Application\Controller\Contact\Update(
            $this->contactRepository
        );

        $contactUpdate->run($data['contacts'], $id);
    }
}