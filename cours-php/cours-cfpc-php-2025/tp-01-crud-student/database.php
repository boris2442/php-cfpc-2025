<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
// define("DBUSER", "postgresql");
define("DBPASS", "");
define("DBNAME", "tp-01-crud-student");

// $dsn = "pgsql:dbname=" . DBNAME . "; host=" . DBHOST;
$dsn = "mysql:dbname=" . DBNAME . "; host=" . DBHOST;
try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    // $db->setAttribute(attribute:PDO::FETCH_ASSOC);
    $db->exec("SET NAMES utf8");
    echo "connexion a la database reussie";
   
} catch (PDOException $e) {
    die($e->getMessage());
  
}
?>