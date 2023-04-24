<?php
declare(strict_types=1);
require_once 'connect.php';
require_once 'user_class.php';

$userId = (int)$_GET['user_id'];
if (!$userId)
{
    echo "Error: Invalid ID";
    return false;
}

$connection = connectDatabase();
$user = findUserInDatabase($connection, $userId);

if (!$user)
{
    echo "Error: User not found";
    return false;
}

function findUserInDatabase(PDO $connection, int $id): ?User
{
    $query = <<<SQL
        SELECT 
            user_id, first_name, last_name, middle_name, gender, birth_date, email, phone, avatar_path
        FROM user
        WHERE user_id = $id
        SQL;
    $statement = $connection->query($query);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row ? new User($row['user_id'], $row['first_name'], $row['last_name'], $row['middle_name'], $row['gender'], $row['birth_date'], $row['email'], $row['phone'], $row['avatar_path']) : null;
}

require 'user.php';
