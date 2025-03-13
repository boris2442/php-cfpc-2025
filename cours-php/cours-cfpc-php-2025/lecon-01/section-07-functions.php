<?php
function hello($name): void
{
    echo "hello $name<br>";
}

hello(name: 'Owen');

function sum($a, $b)
{
    return $a + $b;
}
echo "Sum of 10 and 15 is: " . sum(10, 15) . "<br>";


function sumAll(...$nums) {
    return array_reduce($nums, fn($carry, $n) => $carry + $n, 0);
   }
   echo "Sum of numbers 1,2,3,4,5, 6, 7, 8, 9: " . sumAll(1, 2, 3, 4, 5, 6, 7, 8, 9) . "<br>";
