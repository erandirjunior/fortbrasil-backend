<?php

namespace SRC\Infrastructure\Repository;

use SRC\Domain\Establishment\Interfaces\InputBoundery;
use SRC\Domain\Establishment\Interfaces\InputSearchBoundery;

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
                                                (name, zip_code, number, street, city, state)
                                            VALUE
                                                (?, ?, ?, ?, ?, ?)");

        $stmt->bindValue(1, $inputBoundery->getName());
        $stmt->bindValue(2, $inputBoundery->getZipCode());
        $stmt->bindValue(3, $inputBoundery->getNumber());
        $stmt->bindValue(4, $inputBoundery->getStreet());
        $stmt->bindValue(5, $inputBoundery->getCity());
        $stmt->bindValue(6, $inputBoundery->getState());

        return $stmt->execute() ? $this->connection->lastInsertId() : 0;
    }

    public function delete(int $id)
    {
        $stmt = $this->connection->prepare("UPDATE establishment
                                            SET
                                                deleted_at = now()
                                            WHERE
                                                id = ?");

        $stmt->bindValue(1, $id);

        $stmt->execute();
    }

    public function update(InputBoundery $inputBoundery, int $id): bool
    {
        $stmt = $this->connection->prepare("UPDATE establishment
                                            SET
                                                name = ?,
                                                zip_code = ?,
                                                number = ?,
                                                street = ?,
                                                city = ?,
                                                state = ?,
                                                updated_at = NOW()
                                            WHERE
                                                id = ?");

        $stmt->bindValue(1, $inputBoundery->getName());
        $stmt->bindValue(2, $inputBoundery->getZipCode());
        $stmt->bindValue(3, $inputBoundery->getNumber());
        $stmt->bindValue(4, $inputBoundery->getStreet());
        $stmt->bindValue(5, $inputBoundery->getCity());
        $stmt->bindValue(6, $inputBoundery->getState());
        $stmt->bindValue(7, $id);

        return $stmt->execute();
    }

    public function find(InputSearchBoundery $inputSearchBoundery): array
    {
        $stmt = $this->connection->prepare("SELECT
                                                id,
                                                name,
                                                zip_code,
                                                number,
                                                street,
                                                city,
                                                state
                                            FROM
                                                establishment
                                            WHERE
                                                deleted_at IS NULL AND
                                                name LIKE CONCAT('%', ?, '%') AND
                                                street LIKE CONCAT('%', ?, '%') AND
                                                city LIKE CONCAT('%', ?, '%') AND
                                                state LIKE CONCAT('%', ?, '%')");
        $stmt->bindValue(1, $inputSearchBoundery->getName());
        $stmt->bindValue(2, $inputSearchBoundery->getStreet());
        $stmt->bindValue(3, $inputSearchBoundery->getCity());
        $stmt->bindValue(4, $inputSearchBoundery->getState());

        return $stmt->execute() ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
    }
}