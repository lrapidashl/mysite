<!DOCTYPE html>
<html>
    <head>
        <style>
            .error 
            {
                color: #FF0000;
            }
        </style>
    </head>
    <body>
        <?php 
            require_once 'validation.php';
            require_once 'getUserData.php';
        ?>
        <h3>Введите данные:</h3>
        <span class="error"><?php echo $imgErr;?></span><br />
        <span class="error"><?php echo $uniqErr;?></span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
            <p>
                Фамилия: <input type="text" name="surname" />
                <span class="error">* <?php echo $err['surname'];?></span>
            </p>
            <p>
                Имя: <input type="text" name="name" />
                <span class="error">* <?php echo $err['name'];?></span>
            </p>
            <p>Отчество: 
                <input type="text" name="patronymic" />
                <span class="error"> <?php echo $err['patronymic'];?></span>
            </p>
            <p>Пол: 
                <input type="radio" name="gender" value="male"/> М
                <input type="radio" name="gender" value="female"/> Ж
                <span class="error">* <?php echo $err['gender'];?></span>
            </p>
            <p>
                Дата рождения: <input type="date" name="birthday" />
                <span class="error">* <?php echo $err['birthday'];?></span>
            </p>
            <p>
                Email: <input type="email" name="email" />
                <span class="error">* <?php echo $err['email'];?></span>
            </p>
            <p>Телефон: <input type="tel" name="telephone" /></p>
            <p>Аватар: <input type="file" name="avatar" /></p>
            <input type="submit" value="Отправить">
        </form>
    </body>
</html>
