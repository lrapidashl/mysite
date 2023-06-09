<?php
/**
 * @var \App\Entity\User $user
 */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= $user->getUserId() ?></title>
    <link rel="stylesheet" href="/css/show_user.css">
</head>
<body>
<div class="post-content">
    <h2><?= htmlentities($user->getFirstName()) ?></h2>
    <h2><?= htmlentities($user->getSecondName()) ?></h2>
    <h2><?= htmlentities($user->getEmail()) ?></h2>
    <h2><?= htmlentities($user->getPhone()) ?></h2>
    <form action="<?= "/user/{$user->getUserId()}/delete" ?>" method="post">
        <button type="submit">Удалить пользователя</button>
    </form>
</div>
</body>
</html>