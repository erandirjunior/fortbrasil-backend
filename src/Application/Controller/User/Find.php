<?php

namespace SRC\Application\Controller\User;

use SRC\Application\Exception\ServerException;
use SRC\Application\Exception\ValidateException;
use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\User;
use SRC\Domain\User\Interfaces\UserInput;
use SRC\Domain\User\Interfaces\ValidateDataUpdate;

class Find
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
        $controller = new GetUserDataById($this->repository);
        $data = $controller->run($id);
        $name = '';
        $email = '';

        if (!empty($data['name'])) {
            $name = $data['name'];
        }

        if (!empty($data['email'])) {
            $email = $data['email'];
        }

        echo $this->presenter->json(200, compact('name', 'email'));
    }
}