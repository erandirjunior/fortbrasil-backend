<?php

namespace SRC\Application\Controller\Establishment;

use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\Establishment;

class Delete
{
    private Establishment $repository;

    private JsonPresenter $presenter;

    public function __construct(
        Establishment $establishment,
        JsonPresenter $jsonPresenter
    )
    {
        $this->repository = $establishment;
        $this->presenter = $jsonPresenter;
    }

    public function run(int $id)
    {
        $domain = new \SRC\Domain\Establishment\Delete($this->repository);
        $domain->delete($id);

        echo $this->presenter->json(204);
    }
}