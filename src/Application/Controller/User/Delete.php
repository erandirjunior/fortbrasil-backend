<?php

namespace SRC\Application\Controller\User;

use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\User;

class Delete
{
    private User $repository;

    private JsonPresenter $presenter;

    public function __construct(
        User $user,
        JsonPresenter $jsonPresenter
    )
    {
        $this->repository = $user;
        $this->presenter = $jsonPresenter;
    }

    public function run(int $id)
    {
        $domain = new \SRC\Domain\User\Delete($this->repository);
        $domain->delete($id);

        echo $this->presenter->json(204);
    }
}