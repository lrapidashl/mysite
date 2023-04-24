<?php

function addDefinition(string $row, array &$arr): void
{
    $parsed = explode(':', $row);
    $key = $parsed[0];
    $value = (isset($parsed[1])) ? $parsed[1] : '';
    $arr[$key] = $value;
}

function addRowsFromFileToArray(string $fileName, array &$arr): void
{
    $file = fopen($fileName, 'r');
    while (!feof($file))
    {
        $row = fgets($file);
        if (!str_ends_with($row, "\n"))
        {
            $row .= "\n";
        }
        addDefinition($row, $arr);
    }
    fclose($file);
}

function writeArrToFile(string $fileName, array $arr): void
{
    $file = fopen($fileName, 'w');
    foreach ($arr as $key => $value)
    {
        if ($value !== '')
        {
            fwrite($file, $key . ':' . $value);
        }
        else
        {
            fwrite($file, $key);
        }
    }
    if (fstat($file)['size'] !== 0)
    {
        ftruncate($file, fstat($file)['size'] - 1);
    }
    fclose($file);
}