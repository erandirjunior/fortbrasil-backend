<?php

namespace SRC\Application\Controller\User;

use SRC\Application\Exception\ServerException;
use SRC\Application\Exception\ValidateException;
use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\User;
use SRC\Domain\User\Interfaces\UserInput;
use SRC\Domain\User\Interfaces\ValidateDataUpdate;

class GetUserDataById
{
    private User $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;
    }

    public function run(int $id)
    {
        $domain = new \SRC\Domain\User\FindById(
            $this->repository
        );

        return $domain->find($id);
    }
}