<?php

namespace SRC\Infrastructure\Auth;

use PlugRoute\Http\Request;
use PlugRoute\Middleware\PlugRouteMiddleware;
use SRC\Infrastructure\Security\Token;

class Middleware implements PlugRouteMiddleware
{
    public function handle(Request $request): Request
    {
        try {
            $token = $request->header('HTTP_AUTHORIZATION');

            $tokenComponent = new Token();
            $tokenDecodified = $tokenComponent->decode($token);

            $request->add('userId', $tokenDecodified->sub->id);
        } catch (\Exception $e) {
            return $request->redirectToRoute('permissions');
        }

        return $request;
    }
}