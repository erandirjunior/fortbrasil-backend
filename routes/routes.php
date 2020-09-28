<?php

use \PlugRoute\PlugRoute;
use \PlugRoute\RouteContainer;
use \PlugRoute\Http\RequestCreator;

$route = new PlugRoute(new RouteContainer(), RequestCreator::create());

$route->options('/{anything}', function () {
    return '';
});

$route->post('/login', 'SRC\\Infrastructure\\Api\User\\Login@execute');
$route->post('/register', 'SRC\\Infrastructure\\Api\User\\Create@execute');

$route->get('/permissions', function (\PlugRoute\Http\Response $response) {
    echo $response
        ->setStatusCode(403)
        ->json(['access_permission' => "Você não tem permissão para acessar essa página"]);

})->name('permissions');

$route->group([
    'prefix' => '/',
    'namespace' => 'SRC\Infrastructure\Api',
    'middlewares'=> [\SRC\Infrastructure\Auth\Middleware::class]
], function ($route) {
    $route->group(['prefix' => 'users'], function ($route) {
        $route->get('/{id:\d+}', '\\User\\Find@execute');
        $route->put('/{id:\d+}', '\\User\\Update@execute');
        $route->delete('/{id:\d+}', '\\User\\Delete@execute');
    });

    $route->group(['prefix' => 'establishments'], function ($route) {
        $route->post('', '\\Establishment\\Create@execute');
        $route->get('', '\\Establishment\\Find@execute');
        $route->put('/{id:\d+}', '\\Establishment\\Update@execute');
        $route->delete('/{id:\d+}', '\\Establishment\\Delete@execute');
    });
});


$route->on();