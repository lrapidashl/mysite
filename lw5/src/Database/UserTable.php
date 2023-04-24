<?php
declare(strict_types=1);

namespace App\Database;

use App\Model\User;

class UserTable
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function find(int $id): ?User
    {
        $query = <<<SQL
        SELECT user_id, first_name, last_name, middle_name, gender, birth_date, email, phone, avatar_path
        FROM user
        WHERE user_id = $id
        SQL;

        $statement = $this->connection->query($query);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {
            return $this->createUserFromRow($row);
        }

        return null;
    }

    public function add(User $user): int
    {
        $query = <<<SQL
        INSERT INTO user (first_name, last_name, middle_name, gender, birth_date, email, phone, avatar_path)
        VALUES (:first_name, :last_name, :middle_name, :gender, :birth_date, :email, :phone, :avatar_path)
        SQL;

        $statement = $this->connection->prepare($query);
        try
        {
            $statement->execute([
                ':first_name' => $user->getFirstName(),
                ':last_name' => $user->getLastName(), 
                ':middle_name' => $user->getMiddleName(),
                ':gender' => $user->getGender(),
                ':birth_date' => $user->getBirthDate(),
                ':email' => $user->getEmail(),
                ':phone' => $user->getPhone(),
                ':avatar_path' => $user->getAvatarPath()
            ]);
        }
        catch (PDOException $err)
        {
            echo "Database Error: The user could not be able added. <br />".$err->getMessage();
            return false; 
        }
        catch (Exception $err)
        {
            echo "General Error: The user could not be able added. <br />".$err->getMessage();
            return false; 
        }

        return (int)$this->connection->lastInsertId();
    }

    public function updateAvatarPath(string $avatarPath, int $userId): void
    {
        $query = <<<SQL
        UPDATE user
        SET avatar_path = :avatar_path
        WHERE user_id = :user_id
        SQL;

        $statement = $this->connection->prepare($query);
        try
        {
            $statement->execute([
                ':avatar_path' => $avatarPath,
                ':user_id' => $userId, 
            ]);
        }
        catch (PDOException $err)
        {
            echo "Database Error: The user could not be able added. <br />".$err->getMessage();
        }
        catch (Exception $err)
        {
            echo "General Error: The user could not be able added. <br />".$err->getMessage();
        }
    }

    private function createUserFromRow(array $row): User
    {
        return new User(
            (int)$row['user_id'],
            $row['first_name'],
            $row['last_name'],
            $row['middle_name'],
            $row['gender'],
            $row['birth_date'],
            $row['email'],
            $row['phone'],
            $row['avatar_path']
        );
    }
}