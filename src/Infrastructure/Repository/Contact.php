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
        $stmt = $this->connection->prepare("INSERT INTO establishment_phone
                                                (establishment_id, phone, type)
                                            VALUE
                                                (?, ?, ?)");

        $stmt->bindValue(1, $establishmentId);
        $stmt->bindValue(2, $contact->getPhone());
        $stmt->bindValue(3, $contact->getType());

        return $stmt->execute() ? $this->connection->lastInsertId() : 0;
    }

    public function delete(int $id)
    {
        $stmt = $this->connection->prepare("UPDATE establishment_phone
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
                                                type,
                                                phone
                                            FROM
                                                establishment_phone
                                            WHERE
                                                deleted_at IS NULL AND
                                                establishment_id = ?");

        $stmt->bindValue(1, $id);

        return $stmt->execute() ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
    }

    public function update(\SRC\Domain\Contact\Contact $contact, int $id)
    {
        $stmt = $this->connection->prepare("UPDATE establishment_phone
                                            SET
                                                type = ?,
                                                phone = ?,
                                                updated_at = now()
                                            WHERE
                                                id = ?");
        $stmt->bindValue(1, $contact->getType());
        $stmt->bindValue(2, $contact->getPhone());
        $stmt->bindValue(3, $id);

        $stmt->execute();
    }
}