<?php

namespace SRC\Infrastructure\Api\Establishment;

use PlugRoute\Http\Request;
use SRC\Infrastructure\Database\Connection;
use SRC\Infrastructure\Presenter\JsonPresenter;
use SRC\Infrastructure\Repository\Contact;
use SRC\Infrastructure\Repository\Establishment;

class Create
{
    public function execute(Request $request)
    {
        $connection = new Connection();
        $repository = new Establishment($connection->getConnection());
        $contactrepository = new Contact($connection->getConnection());
        $validator  = new \SRC\Infrastructure\Validator\Establishment();
        $presenter  = new JsonPresenter();

        $controller = new \SRC\Application\Controller\Establishment\Create(
            $repository,
            $validator,
            $presenter,
            $contactrepository
        );

        $controller->run($request->all());
    }
}