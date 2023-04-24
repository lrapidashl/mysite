<?php

if ($argc > 1)
{
    $min = PHP_INT_MAX;
    $max = PHP_INT_MIN;
    for ($i = 1; $i < $argc; $i++)
    {
        $min = ($argv[$i] < $min) ? $argv[$i] : $min;
        $max = ($argv[$i] > $max) ? $argv[$i] : $max;
    }
    echo 'Min: ' . $min . ' Max: ' . $max . "\n";
}
else
{
    echo 'No input' . "\n";
}