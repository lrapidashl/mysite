<?php

function compareFloats(float $value1, float $value2): int
{
    if (abs($value1 - $value2) < PHP_FLOAT_EPSILON)
    {
        return 0;
    }
    elseif ($value2 > $value1)
    {
        return 1;
    }
    else
    {
        return -1;
    }
}

function arrayEquals(array $left, array $rights): bool
{
    return array_diff_assoc($left, $rights) && array_diff_assoc($rights, $left);
}

function arrayNumberFilter(array $data): array
{
    $arrayNumber = [];
    foreach ($data as $i)
    {
        if (is_numeric($i))
        {
            array_push($arrayNumber, $i);
        }
    }
    return $arrayNumber;
}
