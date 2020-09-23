<?php

namespace SRC\Domain\User;

use SRC\Domain\Exception\ServerException;
use SRC\Domain\Exception\ValidateException;
use SRC\Domain\User\Interfaces\CreateRepository;
use SRC\Domain\User\Interfaces\UserInput;
use SRC\Domain\User\Interfaces\ValidateDataCreation;

class Create
{
    private CreateRepository $repository;

    private ValidateDataCreation $validator;

    private UserInput $boundery;

    private ServerException $serverException;

    private ValidateException $validateException;

    public function __construct(
        CreateRepository $createRepository,
        ValidateDataCreation $validator,
        ServerException $serverException,
        ValidateException $validateException
    )
    {
        $this->repository = $createRepository;
        $this->validator = $validator;
        $this->serverException = $serverException;
        $this->validateException = $validateException;
    }

    public function create(UserInput $userInput)
    {
        $this->boundery = $userInput;

        $this->createIfDataAreValids();
    }

    private function createIfDataAreValids()
    {
        if ($this->validator->validate($this->boundery)) {
            $this->validateException
                ->setMessage($this->validator->getErrors());

            throw $this->validateException;
        }

        return $this->createIfUniqueEmail();
    }

    private function createIfUniqueEmail()
    {
        if ($this->repository->findUserByEmail($this->boundery->getEmail())) {
            $this->validateException
                ->setMessage('E-mail já está cadastrado!');

            throw $this->validateException;
        }

        return $this->save();
    }

    private function save()
    {
        $id = $this->repository->create($this->boundery);

        if (!$id) {
            $this->serverException->setMessage('Houve um erro ao registrar os dados');

            throw $this->serverException;
        }
    }
}