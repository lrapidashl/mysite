<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Добавление пользователя</title>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/add_user.css">
</head>
<body class="page">
<form action="/user/create" method="post" class="add-user-form">
    <h2 class="add-user-form__title">Регистрация</h2>
    <div class="add-user-form__inputs">
        <input type="text" name="first_name" placeholder="Введите имя" id="first-name" required maxlength="200" class="add-user-form__input">
        <input type="text" name="second_name" placeholder="Введите фамилию" id="second-name" maxlength="200" class="add-user-form__input">
        <input type="email" name="email" placeholder="Email" id="email" maxlength="320" class="add-user-form__input">
        <input type="text" name="phone" placeholder="Введите телефон" id="phone" required maxlength="200" class="add-user-form__input"  >
        <button type="submit" class="add-user-form__submit">Зарегистрироваться</button>
    </div>
</form>
</body>
</html>