<?php

namespace SRC\Domain\Establishment;

use SRC\Domain\Establishment\Interfaces\CreateRepository;
use SRC\Domain\Establishment\Interfaces\GetLocationByZipCode;
use SRC\Domain\Establishment\Interfaces\InputBoundery;
use SRC\Domain\Establishment\Interfaces\Validator;
use SRC\Domain\Exception\ServerException;
use SRC\Domain\Exception\ValidateException;

class Create
{
    private CreateRepository $repository;

    private Validator $validator;

    private ServerException $serverException;

    private ValidateException $validateException;

    private InputBoundery $inputBoundery;

    public function __construct(
        CreateRepository $createRepository,
        Validator $validator,
        ServerException $serverException,
        ValidateException $validateException
    )
    {
        $this->repository = $createRepository;
        $this->validator = $validator;
        $this->serverException = $serverException;
        $this->validateException = $validateException;
    }

    public function create()
    {

    }

    private function createIfDataAreValids()
    {
        if ($this->validator->validate($this->inputBoundery)) {
            $this->validateException
                ->setMessage($this->validator->getErrors());

            throw $this->validateException;
        }

        return $this->save();
    }

    private function save()
    {
        $id = $this->repository->create($this->inputBoundery);

        if (!$id) {
            $this->serverException->setMessage('Houve um erro ao registrar os dados');

            throw $this->serverException;
        }

//        $this->createContactsIfWereSent($id);
    }
}