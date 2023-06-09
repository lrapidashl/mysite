<?php
/**
 * @var App\Model\User $post
 */
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= $post->getUserId() ?></title>
    <link rel="stylesheet" href="/css/show_user.css">
</head>
<body>
<div class="post-content">
    <h2><?= htmlentities($post->getFirstName()) ?></h2>
    <h2><?= htmlentities($post->getSecondName()) ?></h2>
    <h2><?= htmlentities($post->getEmail()) ?></h2>
    <h2><?= htmlentities($post->getPhone()) ?></h2>
</div>
</body>
</html>