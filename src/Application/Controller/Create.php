<?php

namespace SRC\Application\Controller;

use SRC\Application\Exception\ServerException;
use SRC\Application\Exception\ValidateException;
use SRC\Application\Presenter\JsonPresenter;
use SRC\Application\Repository\Establishment;
use SRC\Domain\Establishment\Interfaces\InputBoundery;
use SRC\Domain\Establishment\Interfaces\Validator;

class Create
{
    private Establishment $repository;

    private Validator $validator;

    private JsonPresenter $presenter;

    /**
     * Create constructor.
     * @param Establishment $repository
     * @param Validator $validator
     */
    public function __construct(
        Establishment $repository,
        Validator $validator,
        JsonPresenter $jsonPresenter
    )
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->presenter = $jsonPresenter;
    }

    public function create(InputBoundery $inputBoundery)
    {
        $validateException  = new ValidateException();
        $serverException    = new ServerException();

        try {
            $domain = new \SRC\Domain\Establishment\Create(
                $this->repository,
                $this->validator,
                $inputBoundery,
                $serverException,
                $validateException
            );

            $domain->create();

            echo $this->presenter->json(201);
        } catch (\Exception $exception) {
            echo $this->presenter->json($exception->getCode(), $exception->getMessage());
        }
    }
}