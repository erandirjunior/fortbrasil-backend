<?php

namespace SRC\Infrastructure\Api;

use SRC\Infrastructure\Database\Connection;
use SRC\Infrastructure\Presenter\JsonPresenter;
use SRC\Infrastructure\Repository\Establishment;

class Create
{
    public function create()
    {
        $connection = new Connection();
        $repository = new Establishment($connection->getConnection());
        $validator  = new \SRC\Infrastructure\Validator\Establishment();
        $presenter  = new JsonPresenter();

        $controller = new \SRC\Application\Controller\Create(
            $repository,
            $validator,
            $presenter
        );

//        $controller->create();
    }
}