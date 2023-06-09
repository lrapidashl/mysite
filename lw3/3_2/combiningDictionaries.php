<?php

function addDefinitionToArr(string $row, array &$definitionArr): void
{
    $parsed = explode(':', $row);
    $key = $parsed[0];
    $value = (isset($parsed[1])) ? $parsed[1] : '';
    $definitionArr[$key] = $value;
}

function addRowsFromFileToArray(string $fileName, array &$arr): void
{
    $file = fopen($fileName, 'r');
    try
    {
        while (!feof($file))
        {
            $row = fgets($file);
            if (!str_ends_with($row, "\n"))
            {
                $row .= "\n";
            }
            addDefinitionToArr($row, $arr);
        }
    }
    catch (Exception $e)
    {
        echo $e->getMessage() . "\n";
    }
    finally
    {
        fclose($file);
    }
}

function writeArrToFile(string $fileName, array $arr): void
{
    $file = fopen($fileName, 'w');
    try
    {
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
    }
    catch (Exception $e)
    {
        echo $e->getMessage() . "\n";
    }
    finally
    {
        fclose($file);
    }
}