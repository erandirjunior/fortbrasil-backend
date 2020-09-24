<?php

use \PlugRoute\PlugRoute;
use \PlugRoute\RouteContainer;
use \PlugRoute\Http\RequestCreator;

$route = new PlugRoute(new RouteContainer(), RequestCreator::create());

$route->options('/{anything}', function () {
    return '';
});

$route->post('login', '\\User\\Login@execute');
$route->post('register', '\\User\\Create@execute');

$route->group(['prefix' => '/', 'namespace' => 'SRC\Infrastructure\Api'], function ($route) {
    $route->group(['prefix' => 'users'], function ($route) {
        $route->get('/{id:\d+}', '\\User\\Find@execute');
        $route->put('/{id:\d+}', '\\User\\Update@execute');
        $route->delete('/{id:\d+}', '\\User\\Delete@execute');
    });

    $route->group(['prefix' => 'establishments'], function ($route) {
        $route->post('', '\\User\\Create@execute');
        $route->get('/names', '\\User\\Find@execute');
        $route->get('/names', '\\User\\Find@execute');
        $route->put('/{id:\d+}', '\\User\\Update@execute');
        $route->delete('/{id:\d+}', '\\User\\Delete@execute');
    });

    $route->get('establishments', '\\Establishment@create');
});


$route->on();