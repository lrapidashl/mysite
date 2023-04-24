<!DOCTYPE html>
<html>
    <body>
        <?php 
            require_once 'validation.php';
            require_once 'add_user.php'; 
        ?>
        <h3>Введите данные:</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
            <p>Фамилия: <input type="text" name="last_name" /></p>
            <p>Имя: <input type="text" name="first_name" /></p>
            <p>Отчество: <input type="text" name="middle_name" /></p>
            <p>Пол: 
                <input type="radio" name="gender" value="male"/> М
                <input type="radio" name="gender" value="female"/> Ж
            </p>
            <p>Дата рождения: <input type="date" name="birth_date" /></p>
            <p>Email: <input type="email" name="email" /></p>
            <p>Телефон: <input type="tel" name="phone" /></p>
            <p>Аватар: <input type="file" name="avatar_path" /></p>
            <input type="submit" value="Отправить">
        </form>
    </body>
</html>
