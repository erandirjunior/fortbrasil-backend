<?php

namespace SRC\Application\Controller\Establishment;

use SRC\Application\Boundery\EstablishmentSearchBoundery;
use SRC\Application\Controller\Contact\FindByEstablishment;
use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\Contact;
use SRC\Application\Repository\Establishment;

class Find
{
    private Establishment $repository;

    private Contact $contactRepository;

    private JsonPresenter $presenter;

    public function __construct(
        Establishment $establishment,
        JsonPresenter $jsonPresenter,
        Contact $contact
    )
    {
        $this->repository = $establishment;
        $this->presenter = $jsonPresenter;
        $this->contactRepository = $contact;
    }

    public function run(array $data)
    {
        $inputBoundery = $this->createEstablishmentBoundery($data);
        $domain = new \SRC\Domain\Establishment\Find($this->repository);
        $data = $domain->find($inputBoundery);
        $contactController = new FindByEstablishment($this->contactRepository);

        foreach ($data as $key => $stablishment) {
            $data[$key]['contacts'] = $contactController->run($stablishment['id']);
        }

        echo $this->presenter->json(200, $data);
    }

    /**
     * @param $data
     * @return EstablishmentSearchBoundery
     */
    private function createEstablishmentBoundery($data): EstablishmentSearchBoundery
    {
        return new EstablishmentSearchBoundery(
            $data['name'],
            $data['state'],
            $data['city'],
            $data['street']
        );
    }
}