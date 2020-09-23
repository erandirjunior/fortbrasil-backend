<?php

use \PlugRoute\PlugRoute;
use \PlugRoute\RouteContainer;
use \PlugRoute\Http\RequestCreator;

$route = new PlugRoute(new RouteContainer(), RequestCreator::create());

$route->options('/{anything}', function () {
    return '';
});

$route->group(['prefix' => '/', 'namespace' => 'SRC\Infrastructure\Api'], function ($route) {
    $route->post('users', '\\User\\Create@create');
    $route->get('establishments', '\\Establishment@create');
});


$route->on();