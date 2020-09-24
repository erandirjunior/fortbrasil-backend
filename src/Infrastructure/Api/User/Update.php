<?php

namespace SRC\Infrastructure\Api\User;

use PlugRoute\Http\Request;
use SRC\Infrastructure\Database\Connection;
use SRC\Infrastructure\Presenter\JsonPresenter;
use SRC\Infrastructure\Repository\User;

class Update
{
    public function execute(Request $request)
    {
        $connection = new Connection();
        $repository = new User($connection->getConnection());
        $validator  = new \SRC\Infrastructure\Validator\User();
        $presenter  = new JsonPresenter();

        $controller = new \SRC\Application\Controller\User\Update(
            $validator,
            $repository,
            $presenter
        );

        $controller->run($request->all(), $request->parameter('id'));
    }
}