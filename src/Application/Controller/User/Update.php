<?php

namespace SRC\Application\Controller\User;

use SRC\Application\Exception\ServerException;
use SRC\Application\Exception\ValidateException;
use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\User;
use SRC\Domain\User\Interfaces\UserInput;
use SRC\Domain\User\Interfaces\ValidateDataUpdate;

class Update
{

    private ValidateDataUpdate $validator;

    private User $repository;

    private JsonPresenter $presenter;

    public function __construct(
        ValidateDataUpdate $validator,
        User $user,
        JsonPresenter $jsonPresenter
    )
    {
        $this->validator = $validator;
        $this->repository = $user;
        $this->presenter = $jsonPresenter;
    }

    public function run(UserInput $userInput, int $id)
    {
        $validateException  = new ValidateException();
        $serverException    = new ServerException();

        try {
            $domain = new \SRC\Domain\User\Update(
                $this->repository,
                $this->validator,
                $serverException,
                $validateException
            );

            $domain->update($userInput, $id);

            echo $this->presenter->json(201);
        } catch (\Exception $exception) {
            echo $this->presenter->json($exception->getCode(), $exception->getMessage());
        }
    }
}