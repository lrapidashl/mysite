<?php
$err = [
    'surname' => '',
    'name' => '',
    'patronymic' => '',
    'gender' => '',
    'birthday' => '',
    'email' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if (empty($_POST['surname']))
    {
        $err['surname'] = 'Введите фамилию';
    } 
    else 
    {
        $_POST['surname'] = test_input($_POST['surname']);
        if (!preg_match("/^(([a-zA-Z' -]{1,30})|([а-яА-ЯЁё' -]{1,30}))$/u", $_POST['surname']))
        {
            $err['surname'] = 'Введите корректную фамилию';
        }
    }

    if (empty($_POST['name']))
    {
        $err['name'] = 'Введите имя';
    } 
    else 
    {
        $_POST['name'] = test_input($_POST['name']);
        if (!preg_match("/^(([a-zA-Z' -]{1,30})|([а-яА-ЯЁё' -]{1,30}))$/u", $_POST['name']))
        {
            $err['name'] = 'Введите корректное имя';
        }
    }

    if (!empty($_POST['patronymic']))
    {
        $_POST['patronymic'] = test_input($_POST['patronymic']);
        if (!preg_match("/^(([a-zA-Z' -]{1,30})|([а-яА-ЯЁё' -]{1,30}))$/u", $_POST['patronymic']))
        {
            $err['patronymic'] = 'Введите корректное отчество';
        }
    } 
    else
    {
        unset($_POST['patronymic']);
    }
    
    if (empty($_POST['gender']))
    {
        $err['gender'] = 'Выберите пол';
    } 
    else 
    {
        $_POST['gender'] = test_input($_POST['gender']);
    }
    
    if (empty($_POST['birthday']))
    {
        $err['birthday'] = 'Выберите дату рождения';
    } 
    else 
    {
        $_POST['birthday'] = test_input($_POST['birthday']);
    }

    if (empty($_POST['email']))
    {
        $err['email'] = 'Введите email';
    } 
    else 
    {
        $_POST['email'] = test_input($_POST['email']);
    }

    if (!empty($_POST['telephone']))
    {
        $_POST['telephone'] = test_input($_POST['telephone']);
    }
    else
    {
        unset($_POST['telephone']);
    }

    if (!empty($_POST['avatar']))
    {
        $_POST['avatar'] = test_input($_POST['avatar']);
    }
    else
    {
        unset($_POST["avatar"]);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}