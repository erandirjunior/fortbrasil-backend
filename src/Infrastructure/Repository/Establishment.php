<?php

namespace SRC\Infrastructure\Repository;

use SRC\Domain\Establishment\Interfaces\InputBoundery;

class Establishment implements \SRC\Application\Repository\Establishment
{
    private $connection;

    public function __construct(\PDO $pdo)
    {
        $this->connection = $pdo;
    }

    public function create(InputBoundery $inputBoundery)
    {
        $stmt = $this->connection->prepare("INSERT INTO establishment
                                                (name, zip_code, number, street, city, state, complement)
                                            VALUE
                                                (?, ?, ?, ?, ?, ?, ?)");

        $stmt->bindValue(1, $inputBoundery->getName());
        $stmt->bindValue(2, $inputBoundery->getZipCode());
        $stmt->bindValue(3, $inputBoundery->getNumber());
        $stmt->bindValue(4, $inputBoundery->getStreet());
        $stmt->bindValue(5, $inputBoundery->getCity());
        $stmt->bindValue(6, $inputBoundery->getState());
        $stmt->bindValue(7, $inputBoundery->getComplement());

        return $stmt->execute() ? $this->connection->lastInsertId() : 0;
    }
}