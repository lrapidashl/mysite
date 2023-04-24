<?php

require_once 'utils.php';

echo compareFloats(1.12345, 1.12345) . "\n";
echo compareFloats(1.12344, 1.12345) . "\n";
echo compareFloats(1.12345, 1.12344) . "\n";

echo arrayEquals([1, 'a' => 'a', 'b' => 'b', 'c'], ['a' => 'a', 'c', 'b' => 'b', 1]) . "\n";
echo arrayEquals([1, 'b' => 'b', 'a' => 'a', 'c'], [1, 'a' => 'a', 'b' => 'b', 'c']) . "\n";

print_r(arrayNumberFilter([1, 'a', 5, 0.12421, 'b', 'c', 2, 'a' => 2, 'b' => 'a']));
