<?php

namespace SRC\Infrastructure\Api\User;

use PlugRoute\Http\Request;
use SRC\Infrastructure\Boundery\UserBoundery;
use SRC\Infrastructure\Database\Connection;
use SRC\Infrastructure\Presenter\JsonPresenter;
use SRC\Infrastructure\Repository\User;
use SRC\Infrastructure\Security\Token;

class Login
{
    public function execute(Request $request)
    {
        $connection = new Connection();
        $repository = new User($connection->getConnection());
        $presenter  = new JsonPresenter();

        $controller = new \SRC\Application\Controller\User\Login(
            $repository,
            $presenter,
            new Token()
        );

        $controller->run($request->all());
    }
}