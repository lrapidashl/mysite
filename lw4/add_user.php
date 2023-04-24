<?php
declare(strict_types=1);

require_once 'connect.php';
require_once 'user_class.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    return;
}

handleAddPost();

function handleAddPost()
{
    $avatarName = (is_uploaded_file($_FILES['avatar_path']['tmp_name'])) ? basename($_FILES['avatar_path']['name']) : null;
    echo $avatarName;
    $user = new User(null, $_POST['first_name'], $_POST['last_name'], $_POST['middle_name'], $_POST['gender'], $_POST['birth_date'], $_POST['email'], $_POST['phone'], $avatarName);
    $connection = connectDatabase();
    $userId = saveUserToDatabase($connection, $user);
    header('Location: ' . "/show_user.php?user_id=$userId", true, 303);
}

function saveUserToDatabase(PDO $connection, User $user): int
{
    $query = <<<SQL
        INSERT INTO user (first_name, last_name, middle_name, gender, birth_date, email, phone, avatar_path)
        VALUES (:first_name, :last_name, :middle_name, :gender, :birth_date, :email, :phone, :avatar_path)
        SQL;
    $statement = $connection->prepare($query);
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
    return (int)$connection->lastInsertId();
}