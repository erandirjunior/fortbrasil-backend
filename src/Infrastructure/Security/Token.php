<?php

namespace SRC\Infrastructure\Security;

class Token
{
    public function encode($data)
    {
        $key = 'myKey';
        $issuedAt = time();
        $exp = $issuedAt + 43200;

        $token = array(
            "iss" => "local",
            "iat" => $issuedAt,
            "sub" => $data,
            "exp" => $exp
        );

        return \Firebase\JWT\JWT::encode($token, $key);
    }

    public function decode($jwt)
    {
        return \Firebase\JWT\JWT::decode($jwt, 'myKey', ['HS256']);
    }
}