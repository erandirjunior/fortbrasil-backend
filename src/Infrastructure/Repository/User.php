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

    public function create(UserInput $userInput): bool
    {
        $stmt = $this->connection->prepare("INSERT INTO user
                                                (name, email, password)
                                            VALUE
                                                (?, ?, ?)");

        $stmt->bindValue(1, $userInput->getName());
        $stmt->bindValue(2, $userInput->getEmail());
        $stmt->bindValue(3, $userInput->getPasswordEncrypted());

        return $stmt->execute() ? $this->connection->lastInsertId() : 0;
    }

    public function findUserByEmail(string $email): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE email = ?");

        $stmt->bindValue(1, $email);

        return $stmt->execute() ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
    }

    public function update(UserInput $userInput, int $id): bool
    {
        $stmt = $this->connection->prepare("UPDATE user
                                            SET
                                                name = ?, email = ?, password = ?
                                            WHERE
                                                id = ?");

        $stmt->bindValue(1, $userInput->getName());
        $stmt->bindValue(2, $userInput->getEmail());
        $stmt->bindValue(3, $userInput->getPasswordEncrypted());
        $stmt->bindValue(4, $id);

        return $stmt->execute() ? $this->connection->lastInsertId() : 0;
    }

    public function checkIfHasCanUseEmail(string $email, int $id): bool
    {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE email = ? AND id != ?");

        $stmt->bindValue(1, $email);
        $stmt->bindValue(2, $id);

        $stmt->execute();

        return !!$stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find(int $id): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = ?");

        $stmt->bindValue(1, $id);

        return $stmt->execute() ? $stmt->fetch(\PDO::FETCH_ASSOC) : [];
    }
}