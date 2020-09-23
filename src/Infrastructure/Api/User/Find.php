<?php

namespace SRC\Infrastructure\Api\User;

use PlugRoute\Http\Request;
use SRC\Infrastructure\Database\Connection;
use SRC\Infrastructure\Presenter\JsonPresenter;
use SRC\Infrastructure\Repository\User;

class Find
{
    public function execute(Request $request)
    {
        $connection = new Connection();
        $repository = new User($connection->getConnection());
        $presenter  = new JsonPresenter();
        $controller = new \SRC\Application\Controller\User\Find(
            $repository,
            $presenter
        );

        $controller->run($request->parameter('id'));
    }
}