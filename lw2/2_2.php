<?php

if ($argc > 1)
{
    $min = substr($argv[1], 0, strpos($argv[1], '='));
    $max = substr($argv[1], 0, strpos($argv[1], '='));
    for ($i = 1; $i < $argc; $i++)
    {
        $argv[$i] = substr($argv[$i], 0, strpos($argv[$i], '='));
        $min = (strncmp($min, $argv[$i], max(strlen($min), strlen($argv[$i]))) === 1) ? $argv[$i] : $min;
        $max = (strncmp($max, $argv[$i], max(strlen($max), strlen($argv[$i]))) === -1) ? $argv[$i] : $max;
    }
    echo 'Min: ' . $min . ' Max: ' . $max . "\n";
}
else
{
    echo 'No input' . "\n";
}