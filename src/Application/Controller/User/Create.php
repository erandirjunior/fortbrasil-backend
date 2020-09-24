<?php

namespace SRC\Application\Controller\User;

use SRC\Application\Boundery\UserBoundery;
use SRC\Application\Exception\ServerException;
use SRC\Application\Exception\ValidateException;
use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\User;
use SRC\Domain\User\Interfaces\ValidateDataCreation;

class Create
{
    private ValidateDataCreation $validator;

    private User $repository;

    private JsonPresenter $presenter;

    public function __construct(
        ValidateDataCreation $validateDataCreation,
        User $user,
        JsonPresenter $jsonPresenter
    )
    {
        $this->validator = $validateDataCreation;
        $this->repository = $user;
        $this->presenter = $jsonPresenter;
    }

    public function run(array $data)
    {
        $validateException  = new ValidateException();
        $serverException    = new ServerException();

        try {
            $boundery = new UserBoundery(
                $validateException,
                $data['name'],
                $data['email'],
                $data['password']
            );

            $domain = new \SRC\Domain\User\Create(
                $this->repository,
                $this->validator,
                $serverException,
                $validateException
            );

            $domain->create($boundery);

            echo $this->presenter->json(201);
        } catch (\Exception $exception) {
            echo $this->presenter->json($exception->getCode(), $exception->getMessage());
        }
    }
}