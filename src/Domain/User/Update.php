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

    public function update(UserUpdateInput $updateInput, int $id, bool $updatedPassword)
    {
        $this->boundery = $updateInput;

        $this->createIfDataAreValids($id, $updatedPassword);
    }

    private function createIfDataAreValids($id, $updatedPassword)
    {
        if ($this->validator->validateUpdateData($this->boundery)) {
            $this->validateException
                ->setMessage($this->validator->getErrors());

            throw $this->validateException;
        }

        return $this->createIfUniqueEmail($id, $updatedPassword);
    }

    private function createIfUniqueEmail($id, $updatedPassword)
    {
        if ($this->repository->checkIfHasCanUseEmail($this->boundery->getEmail(), $id)) {
            $this->validateException
                ->setMessage('E-mail já está cadastrado!');

            throw $this->validateException;
        }

        return $this->save($id, $updatedPassword);
    }

    private function save($id, $updatedPassword)
    {
        if (!$updatedPassword) {
            $this->updateNameAndEmail($id);

            return;
        }

        $this->updateAllData($id);
    }

    private function updateAllData($id)
    {
        if (!$this->repository->updateAll($this->boundery, $id)) {
            $this->serverException->setMessage('Houve um erro ao atualizar os dados!');

            throw $this->serverException;
        }
    }

    private function updateNameAndEmail($id)
    {
        if (!$this->repository->updateNameAndEmail($this->boundery, $id)) {
            $this->serverException->setMessage('Houve um erro ao atualizar os dados!');

            throw $this->serverException;
        }
    }
}