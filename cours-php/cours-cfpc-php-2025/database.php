<?php
// $hostname="127.0.0.1";
// $username="root";
// $password="";
// $database="cours-cfpc-php-2025";
// // $connect=new mysqli(hostname:$hostname, username:$username, password:$password, database:$database);
// $connect=new PDO(hostname:$hostname, username:$username, password:$password, database:$database);

// if($connect->connect_error){
//     echo "Erreur:mauvaise connexion a la database";
//     $connect->connect_error;
// }else{
//     echo "Succes:connexion a la database reussie";
// }


// define("DBUSER", "postgresql");



// $dsn = "pgsql:dbname=" . DBNAME . "; host=" . DBHOST;

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBNAME", "espace_membre_2025");

define("DBPASS", "");
$dsn = "mysql:dbname=" . DBNAME . "; host=" . DBHOST;
try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->exec("SET NAMES utf8");
    // echo "Connexion à la base de données réussie";
} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
}
