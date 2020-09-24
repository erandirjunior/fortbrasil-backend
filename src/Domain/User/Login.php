<?php

namespace SRC\Domain\User;

use SRC\Domain\Exception\ValidateException;
use SRC\Domain\User\Interfaces\FindByEmailRepository;
use SRC\Domain\User\Interfaces\UserLoginInput;

class Login
{
    private FindByEmailRepository $repository;

    private ValidateException $validateException;

    /**
     * Login constructor.
     * @param FindByEmailRepository $repository
     */
    public function __construct(
        FindByEmailRepository $repository,
        ValidateException $validateException
    )
    {
        $this->repository = $repository;
        $this->validateException = $validateException;
    }

    public function login(UserLoginInput $userLoginInput)
    {
        $user = $this->repository->findUserByEmail($userLoginInput->getEmail());

        if (!$user) {
            $this->validateException->setMessage('Usuário não encontrado!');

            throw $this->validateException;
        }

        if (!password_verify($userLoginInput->getPassword(), $user['password'])) {
            $msg = 'Erro ao efetuar login, verifique os dados e tente novamente!';
            $this->validateException->setMessage($msg);

            throw $this->validateException;
        }

        return [
            'name' => $user['name'],
            'email' => $user['email'],
        ];
    }
}