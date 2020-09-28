<?php

namespace SRC\Application\Controller\User;

use SRC\Application\Boundery\UserLoginBoundery;
use SRC\Application\Exception\ServerException;
use SRC\Application\Exception\ValidateException;
use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\User;
use SRC\Domain\User\Interfaces\Token;
use SRC\Domain\User\Interfaces\UserInput;
use SRC\Domain\User\Interfaces\ValidateDataUpdate;

class Login
{
    private User $repository;

    private JsonPresenter $presenter;

    private Token $token;

    public function __construct(
        User $user,
        JsonPresenter $jsonPresenter,
        Token $token
    )
    {
        $this->repository = $user;
        $this->presenter = $jsonPresenter;
        $this->token = $token;
    }

    public function run(array $data)
    {
        $validateException  = new ValidateException();

        try {
            $boundery = new UserLoginBoundery(
                $validateException,
                $data['email'],
                $data['password']
            );

            $domain = new \SRC\Domain\User\Login(
                $this->repository,
                $validateException,
                $this->token
            );

            $userData = $domain->login($boundery);

            echo $this->presenter->json(200, $userData);
        } catch (\Exception $exception) {
            echo $this->presenter->json($exception->getCode(), $exception->getMessage());
        }
    }
}