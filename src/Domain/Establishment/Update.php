<?php

namespace SRC\Domain\Establishment;

use SRC\Domain\Establishment\Interfaces\CreateRepository;
use SRC\Domain\Establishment\Interfaces\InputBoundery;
use SRC\Domain\Establishment\Interfaces\UpdateRepository;
use SRC\Domain\Establishment\Interfaces\Validator;
use SRC\Domain\Exception\ServerException;
use SRC\Domain\Exception\ValidateException;

class Update
{
    private UpdateRepository $repository;

    private Validator $validator;

    private ServerException $serverException;

    private ValidateException $validateException;

    private InputBoundery $inputBoundery;

    public function __construct(
        UpdateRepository $updateRepository,
        Validator $validator,
        ServerException $serverException,
        ValidateException $validateException
    )
    {
        $this->repository = $updateRepository;
        $this->validator = $validator;
        $this->serverException = $serverException;
        $this->validateException = $validateException;
    }

    public function update(InputBoundery $inputBoundery, int $id)
    {
        $this->inputBoundery = $inputBoundery;

        $this->createIfDataAreValids($id);
    }

    private function createIfDataAreValids($id)
    {
        if ($this->validator->validate($this->inputBoundery)) {
            $this->validateException
                ->setMessage($this->validator->getErrors());

            throw $this->validateException;
        }

        $this->save($id);
    }

    private function save($id)
    {
        if (!$this->repository->update($this->inputBoundery, $id)) {
            $this->serverException->setMessage('Houve um erro ao atualizar os dados!');

            throw $this->serverException;
        }
    }
}