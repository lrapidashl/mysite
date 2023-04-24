<?php

if (isset($_GET['password']))
{
    $password = $_GET['password'];
    $reliability = 0;
    $countDigits = preg_match_all("/[0-9]/", $password, $matches);
    $countUpperCase = preg_match_all("/[A-Z]/", $password, $matches);
    $countLowerCase = preg_match_all("/[a-z]/", $password, $matches);
    $countLetters = preg_match_all("/[A-Z]|[a-z]/", $password, $matches);

    $reliability += 4 * strlen($password);
    echo 'Символы дают: +' . 4 * strlen($password) . "<br />";
    if ($countDigits > 0)
    {
        $reliability += 4 * $countDigits;
        echo 'Цифры дают: +' . 4 * $countDigits  . "<br />";
    }
    if ($countUpperCase > 0)
    {
        $reliability += 2 * (strlen($password) - $countUpperCase);
        echo 'Верхний регистр даёт: +' . 2 * (strlen($password) - $countUpperCase) . "<br />";
    }
    if ($countLowerCase > 0)
    {
        $reliability += 2 * (strlen($password) - $countLowerCase);
        echo 'Нижний регистр даёт: +' . 2 * (strlen($password) - $countLowerCase) . "<br />";
    }
    if (($countLetters === 0) || ($countDigits === 0))
    {
        $reliability -= strlen($password);
        echo 'Использование только одного типа символов даёт: -' . strlen($password) . "<br />";
    }

    $similar = 0;
    foreach (array_count_values(str_split($password)) as $i)
    {
        if ($i > 1)
        {
            $similar += $i;
        }
    }
    $reliability -= $similar;
    echo 'Одинаковые символы дают: -' . $similar . "<br /><br />";
    echo 'Надёжность пароля: ' . $reliability . "<br />";
}
else
{
    echo 'No input';
}