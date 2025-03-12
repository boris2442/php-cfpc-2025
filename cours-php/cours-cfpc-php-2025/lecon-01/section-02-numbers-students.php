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

$strNumber='12.45';
$number=(float)$strNumber;//on peut aussi utiliser $floatval

//8. les fonctions  en mathematiques
echo "<pre>";
echo "la racine carrée de 16 est : ".sqrt(16);
echo "<br>";
echo "l'exponentielle de 2 est : ".exp(2);
echo "<br>";
echo "la logarithme naturelle de 2 est : ".log(2);

echo "floor(2.6) est : ".floor(2.6).'<br>';

echo "ceil(2,6) est : ".ceil(2.5).'<br>';
echo "round(2.5) est : ".round(2.5).'<br>';
echo "abs(2.5) est : ".abs(-100.5).'<br>';
echo "pow(2, 20) est".pow(2, 20).'<br>';

echo "</pre>";


echo pow(2, 3); // Affiche 8 (2^3)


//abs : Cette fonction retourne la valeur absolue d'un nombre, c'est-à-dire la distance de ce nombre à zéro sans tenir compte du signe.

//ceil : Cette fonction retourne le plus petit entier supérieur ou égal à un nombre donné.

//pow : Cette fonction retourne la valeur d'un nombre élevé à la puissance d'un autre nombre.

//round : Cette fonction arrondit un nombre à l'entier le plus proche. Elle peut également arrondir à un certain nombre de décimales si un deuxième argument est fourni.

//floor : Cette fonction retourne le plus grand entier inférieur ou égal à un nombre donné.

//Ces fonctions sont couramment utilisées pour effectuer des opérations mathématiques de base en PHP.


$nombre = 1234.56;
echo number_format(
 num: $nombre,
 decimals: 2,
 decimal_separator: '.',
 thousands_separator: ','
) . '<br>';


echo "<pre>";

$personDetails = [
    'firstName' => 'Owen',
    'lastName' => 'Eva',
    'age' => 25,
    'occupation' => 'Developer'
   ];
   foreach ($personDetails as $key => $value) {
    echo "$key: $value<br>";
   }
   echo "</pre>";