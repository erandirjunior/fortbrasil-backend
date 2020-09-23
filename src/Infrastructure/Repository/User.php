<?php

namespace SRC\Infrastructure\Repository;

use SRC\Domain\User\Interfaces\UserInput;

class User implements \SRC\Application\Repository\User
{
    private $connection;

    public function __construct(\PDO $pdo)
    {
        $this->connection = $pdo;
    }

    /*public function create(InputBoundery $inputBoundery)
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
    }*/
    public function create(UserInput $userInput): bool
    {
        $stmt = $this->connection->prepare("INSERT INTO user
                                                (name, email, password)
                                            VALUE
                                                (?, ?, ?)");

        $stmt->bindValue(1, $userInput->getName());
        $stmt->bindValue(2, $userInput->getEmail());
        $stmt->bindValue(3, $userInput->getPassword());

        return $stmt->execute() ? $this->connection->lastInsertId() : 0;
    }

    public function findUserByEmail(string $email): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE email = ?");

        $stmt->bindValue(1, $email);

        return $stmt->execute() ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
    }
}