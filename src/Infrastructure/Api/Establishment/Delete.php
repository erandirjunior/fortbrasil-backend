<?php

namespace SRC\Infrastructure\Api\Establishment;

use PlugRoute\Http\Request;
use SRC\Infrastructure\Database\Connection;
use SRC\Infrastructure\Presenter\JsonPresenter;
use SRC\Infrastructure\Repository\Establishment;

class Delete
{
    public function execute(Request $request)
    {
        $connection = new Connection();
        $repository = new Establishment($connection->getConnection());
        $presenter  = new JsonPresenter();

        $controller = new \SRC\Application\Controller\Establishment\Delete(
            $repository,
            $presenter
        );

        $controller->run($request->parameter('id'));
    }
}