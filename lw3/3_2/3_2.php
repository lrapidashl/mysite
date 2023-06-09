<?php

require_once 'combiningDictionaries.php';

$dir = './dict';
if (file_exists($dir))
{
    $files = scandir($dir);
    $definitions = [];

    for ($i = 2; $i < count($files); $i++) // начинаем со 2 элемента, чтобы избавиться от "." и ".."
    {
        addRowsFromFileToArray($dir . '/' . $files[$i], $definitions);
    }

    ksort($definitions, SORT_STRING);

    writeArrToFile('dir.txt', $definitions);
}
else
{
    echo "Error. There is no directory " . $dir;
}
