<?php
$a = 5;
$b = 4;
$c = 1.9;

echo "addition:" . ($a + $b) . '<br>';
echo "Soustraction" . ($a - $b) . '<br>';
echo "multiplacation:" . ($a * $b) . '<br>';

echo "modulo " . ($a % $b) . '<br>';



//3. Les operateurs d'assignations


//$a+=$b;
//$a-=$b; $a=$a-$b;
//$a*=$b => $a=$a*$b;



//4. LEs operations post-increments et pre-increments
//++a, a++; --a, a--;


// Post-incrément
echo "<pre>";
$a = 5;
var_dump($a);
echo "Valeur de \$a avant post-incrément: " . $a . "<br>"; // Affiche 5
echo "Valeur de \$a après post-incrément: " . $a++ . "<br>"; // Affiche 5 puis incrémente $a à 6
echo "Valeur de \$a après l'opération: " . $a . "<br>"; // Affiche 6

echo "<br>";

// Pré-incrément
$b = 5;
echo "Valeur de \$b avant pré-incrément: " . $b . "<br>"; // Affiche 5
echo "Valeur de \$b après pré-incrément: " . ++$b . "<br>"; // Incrémente $b à 6 puis affiche 6
echo "Valeur de \$b après l'opération: " . $b . "<br>"; // Affiche 6

echo "</pre>";


//les fonctions de verifications
//ilen existe plusieurs telque :is_int, is_string, is_array, is_object, is_bool, is_float


$age = 123;
if(!(is_int($age))){
   echo "l'age de l'individu doit etre  un nombre entier";
}else{
    echo "L'age de cet individu est : ".$age;
}

//7. les conversions de chaine en nombre