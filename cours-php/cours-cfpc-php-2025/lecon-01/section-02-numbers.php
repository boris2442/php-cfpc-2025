<?php
$a=5;
$b=4;
$c=40;
$d=0;

echo "addition".($a+$b) . "<br>";
echo "Soustraction".($a-$b) . "<br>";
echo "multiplication".($a*$b) . "<br>";
echo "division".($a/$b) . "<br>";
echo "Modulo".($a%$b) . "<br>";

//rappels:les interpolations  en php se font uniquement avec les doubles cotes
//par exemple,

echo "Addition $a +$b";

//fdiv permer de donner enormement de nouveaute

echo "division flottante  avec fdiv:". fdiv(num1:$a, num2:$c).'<br>';

//les operateurs d'incrementations
$a=5;
echo "Post-incrément (\$a++): " . $a++ . '<br>'; // Affiche 5, puis $a devient 6
echo "Pré-incrément (++\$a): " . ++$a . '<br>'; // Incrémente à 7 puis affiche 7


//les operateurs d'decrementations
?>