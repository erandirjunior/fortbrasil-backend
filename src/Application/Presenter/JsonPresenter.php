<?php

namespace SRC\Application\Presenter;

use PlugHttp\Response;

interface JsonPresenter
{
    public function json($code = 200, $body = []);
}