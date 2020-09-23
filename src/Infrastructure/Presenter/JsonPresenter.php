<?php

namespace SRC\Infrastructure\Presenter;

use PlugHttp\Response;

class JsonPresenter implements \SRC\Application\Presenter\JsonPresenter
{
    private Response $response;

    public function __construct()
    {
        $this->response = new Response();
    }

    public function json($code = 200, $body = [])
    {
        if (is_string($body)) {
            $body = [$body];
        }
        return $this->response
            ->setStatusCode($code)
            ->response()
            ->json($body);
    }
}