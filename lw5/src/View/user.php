<?php
/**
 * @var App\Model\User $user
 */
?>

<!DOCTYPE html>
<html lang="ru">
    <header>
        <title><?= htmlspecialchars($user->getFirstName()) ?></title>
    </header>
    <div>
        <h1>
            <?= htmlspecialchars($user->getLastName()) ?>
            <?= htmlspecialchars($user->getFirstName()) ?>
            <?= htmlspecialchars($user->getMiddleName()) ?>
        </h1>
        <p>Gender: <?= htmlspecialchars($user->getGender()) ?></p>
        <p>Birth date: <?= htmlspecialchars($user->getBirthDate()) ?></p>
        <p>Email: <?= htmlspecialchars($user->getEmail()) ?></p>
        <p>Phone: <?= htmlspecialchars($user->getPhone()) ?></p>
        <p>Avatar path: <?= htmlspecialchars($user->getAvatarPath()) ?></p>
        <image src='<?= 'uploads/' . $user->getAvatarPath() ?>'/>
    </div>
</html>