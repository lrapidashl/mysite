<?php
declare(strict_types=1);

namespace App\Database;

use App\Entity\User;

class UserTable
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    // Извлекает из БД данные поста с указанным ID.
    // Возвращает null, если пост не найден
    public function find(int $userId): ?User
    {
        $query = <<<SQL
        SELECT
            user_id,
            first_name,
            second_name,
            email,
            phone
        FROM user
        WHERE user_id = $userId
        SQL;

        $statement = $this->connection->query($query);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {
            return $this->createUserFromRow($row);
        }

        return null;
    }

    // Сохраняет юзера в таблицу user, возвращает ID юзера.
    public function add(User $user): int
    {
        $query = <<<SQL
        INSERT INTO user (first_name, second_name, email, phone)
        VALUES (:first_name, :second_name, :email, :phone)
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute([
            ':first_name' => $user->getFirstName(),
            ':second_name' => $user->getSecondName(),
            ':email' => $user->getEmail(),
            ':phone' => $user->getPhone()
        ]);

        return (int)$this->connection->lastInsertId();
    }

    public function delete(int $userId): void
    {
        $query = <<<SQL
        DELETE FROM user WHERE user_id = :user_id
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute([
            ':user_id' => $userId
        ]);
    }

    /**
     * @return User[]
     */
    public function list(): array
    {
        $query = <<<SQL
        SELECT
            user_id,
            first_name,
            second_name,
            email,
            phone
        FROM user
        SQL;

        $statement = $this->connection->query($query);

        $users = [];
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {
            $users[] = $this->createUserFromRow($row);
        }

        return $users;
    }

    private function createUserFromRow(array $row): User
    {
        return new User(
            (int)$row['user_id'],
            $row['first_name'],
            $row['second_name'],
            $row['email'],
            $row['phone']
        );
    }
}
