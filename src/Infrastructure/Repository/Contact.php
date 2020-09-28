<?php

namespace SRC\Infrastructure\Repository;

class Contact implements \SRC\Application\Repository\Contact
{
    private $connection;

    public function __construct(\PDO $pdo)
    {
        $this->connection = $pdo;
    }

    public function create(\SRC\Domain\Contact\Contact $contact, int $establishmentId): int
    {
        $stmt = $this->connection->prepare("INSERT INTO contact
                                                (establishment_id, phone)
                                            VALUE
                                                (?, ?)");

        $stmt->bindValue(1, $establishmentId);
        $stmt->bindValue(2, $contact->getPhone());

        return $stmt->execute() ? $this->connection->lastInsertId() : 0;
    }

    public function delete(int $id)
    {
        $stmt = $this->connection->prepare("UPDATE contact
                                            SET
                                                deleted_at = now()
                                            WHERE
                                                id = ?");

        $stmt->bindValue(1, $id);

        $stmt->execute();
    }

    public function findByEstablishment(int $id): array
    {
        $stmt = $this->connection->prepare("SELECT
                                                id,
                                                phone
                                            FROM
                                                contact
                                            WHERE
                                                deleted_at IS NULL AND
                                                establishment_id = ?");

        $stmt->bindValue(1, $id);

        return $stmt->execute() ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
    }

    public function update(\SRC\Domain\Contact\Contact $contact, int $id)
    {
        $stmt = $this->connection->prepare("UPDATE contact
                                            SET
                                                phone = ?,
                                                updated_at = now()
                                            WHERE
                                                id = ?");

        $stmt->bindValue(1, $contact->getPhone());
        $stmt->bindValue(2, $id);

        $stmt->execute();
    }
}