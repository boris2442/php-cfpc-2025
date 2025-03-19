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

define("DBHOST", "localhost");
define("DBUSER", "root");
// define("DBUSER", "postgresql");
define("DBPASS", "");
define("DBNAME", "cours-cfpc-php-2025");

// $dsn = "pgsql:dbname=" . DBNAME . "; host=" . DBHOST;
$dsn = "mysql:dbname=" . DBNAME . "; host=" . DBHOST;
try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    // $db->setAttribute(attribute:PDO::FETCH_ASSOC);
    $db->exec("SET NAMES utf8");
   
} catch (PDOException $e) {
    die($e->getMessage());
  
}
