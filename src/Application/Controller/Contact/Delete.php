<?php

namespace SRC\Application\Controller\Contact;

use SRC\Application\Repository\Contact;
use SRC\Domain\Contact\Interfaces\DeleteService;

class Delete implements DeleteService
{
    private Contact $repository;

    public function __construct(
        Contact $repository
    )
    {
        $this->repository = $repository;
    }

    public function delete(int $id)
    {
        $domain = new \SRC\Domain\Contact\Delete(
            $this->repository
        );

        return $domain->delete($id);
    }
}