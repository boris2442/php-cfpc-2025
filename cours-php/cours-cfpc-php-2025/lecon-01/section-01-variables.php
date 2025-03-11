
<?php
echo "<pre>";
$nom = 'chaine de caractere <br>';
//les variables:objet dont le contenu peut changer lors de l'execution du programme ou de l'algorithme
$age = 10;
var_dump(value: $age);
echo $nom;
var_dump(value: $nom);
$taille = 1.99;
var_dump(value: $taille);
$revenu = null;
var_dump(value: $revenu);

$isMale = true;
var_dump(value: $isMale);
//les print_r 
print_r($revenu);
echo gettype($taille);
echo "</pre>";


echo "<pre>";
var_dump($age, $isMale, $taille, $revenu);

echo '<br>';
echo "</pre>";

$nom = 14;
var_dump($nom);
echo is_int($nom);


//les issets permettent de verifier si une variable est definie
var_dump(isset($nom));

//09 les constantes
// define('name_de_la_constante', valeur);

define('pi', 3.14);
echo pi . '<br>';
//10 . Utiliser des constantes prédéfinies de PHP
//nous pouvons avoir SORT_ASC  et PHP_INT_MAX;

//pour determiner la valeur maximale d'un entier, on utilise PHP_INT_MAX
//pour pouvoir interpoler, on utilise les doubles cotes
//LA concatenation se fait avec les cotes non doubles

// echo "soit le tableau suivante";
$array=array(4, 50, 10, 36);
sort($array, SORT_ASC);
print_r($array);

//la fonction SORT_ASC permet de classer les elements d'un tableau par ordre croissant 
//exemple: $array=array(50, 25, 10, 200, 40);
//sort($array, SORT_ASC);
?>