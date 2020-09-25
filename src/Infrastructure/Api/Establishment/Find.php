<?php

namespace SRC\Infrastructure\Api\Establishment;

use PlugRoute\Http\Request;
use SRC\Infrastructure\Database\Connection;
use SRC\Infrastructure\Presenter\JsonPresenter;
use SRC\Infrastructure\Repository\Contact;
use SRC\Infrastructure\Repository\Establishment;

class Find
{
    public function execute(Request $request)
    {
        $connection = new Connection();
        $repository = new Establishment($connection->getConnection());
        $contactRepository = new Contact($connection->getConnection());
        $presenter  = new JsonPresenter();

        $controller = new \SRC\Application\Controller\Establishment\Find(
            $repository,
            $presenter,
            $contactRepository
        );

        $controller->run($request->query());
    }
}