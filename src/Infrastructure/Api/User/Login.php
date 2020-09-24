<?php

namespace SRC\Infrastructure\Api\User;

use PlugRoute\Http\Request;
use SRC\Infrastructure\Boundery\UserBoundery;
use SRC\Infrastructure\Database\Connection;
use SRC\Infrastructure\Presenter\JsonPresenter;
use SRC\Infrastructure\Repository\User;

class Login
{
    public function execute(Request $request)
    {
        $connection = new Connection();
        $repository = new User($connection->getConnection());
        $presenter  = new JsonPresenter();

        $controller = new \SRC\Application\Controller\User\Login(
            $repository,
            $presenter
        );

        $controller->run($request->all());
    }
}