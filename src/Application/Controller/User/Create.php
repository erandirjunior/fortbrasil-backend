<?php

namespace SRC\Application\Controller\User;

use SRC\Application\Exception\ServerException;
use SRC\Application\Exception\ValidateException;
use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\User;
use SRC\Domain\User\Interfaces\UserInput;
use \SRC\Domain\User\Interfaces\Validator as UserValidator;

class Create
{

    private UserValidator $validator;

    private User $repository;

    private JsonPresenter $presenter;

    public function __construct(
        UserValidator $validator,
        User $user,
        JsonPresenter $jsonPresenter
    )
    {
        $this->validator = $validator;
        $this->repository = $user;
        $this->presenter = $jsonPresenter;
    }

    public function create(UserInput $userInput)
    {
        $validateException  = new ValidateException();
        $serverException    = new ServerException();

        try {
            $domain = new \SRC\Domain\User\Create(
                $this->repository,
                $this->validator,
                $serverException,
                $validateException
            );

            $domain->create($userInput);

            echo $this->presenter->json(201);
        } catch (\Exception $exception) {
            echo $this->presenter->json($exception->getCode(), $exception->getMessage());
        }
    }
}