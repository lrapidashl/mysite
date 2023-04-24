<!DOCTYPE html>
<html>
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
    </div>
</html>