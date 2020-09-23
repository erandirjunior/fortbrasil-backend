<?php

namespace SRC\Domain\User;

use SRC\Domain\Exception\ServerException;
use SRC\Domain\Exception\ValidateException;
use SRC\Domain\User\Interfaces\UpdateRepository;
use SRC\Domain\User\Interfaces\UserUpdateInput;
use SRC\Domain\User\Interfaces\ValidateDataUpdate;

class Update
{
    private UpdateRepository $repository;

    private ValidateDataUpdate $validator;

    private UserUpdateInput $boundery;

    private ServerException $serverException;

    private ValidateException $validateException;

    public function __construct(
        UpdateRepository $updateRepository,
        ValidateDataUpdate $validateDataUpdate,
        ServerException $serverException,
        ValidateException $validateException
    )
    {
        $this->repository = $updateRepository;
        $this->validator = $validateDataUpdate;
        $this->serverException = $serverException;
        $this->validateException = $validateException;
    }

    public function update(UserInput $userInput, int $id)
    {
        $this->boundery = $userInput;

        $this->createIfDataAreValids($id);
    }

    private function createIfDataAreValids($id)
    {
        if ($this->validator->validateUpdateData($this->boundery)) {
            $this->validateException
                ->setMessage($this->validator->getErrors());

            throw $this->validateException;
        }

        return $this->createIfUniqueEmail($id);
    }

    private function createIfUniqueEmail($id)
    {
        if ($this->repository->checkIfHasCanUseEmail($this->boundery->getEmail(), $id)) {
            $this->validateException
                ->setMessage('E-mail já está cadastrado!');

            throw $this->validateException;
        }

        return $this->save();
    }

    private function save()
    {
        $id = $this->repository->update($this->boundery);

        if (!$id) {
            $this->serverException->setMessage('Houve um erro ao atualizar os dados!');

            throw $this->serverException;
        }
    }
}