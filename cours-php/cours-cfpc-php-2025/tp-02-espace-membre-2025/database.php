<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
// define("DBUSER", "postgresql");
define("DBPASS", "");
define("DBNAME", "tp-02-espace-membre-2025");

// $dsn = "pgsql:dbname=" . DBNAME . "; host=" . DBHOST;
$dsn = "mysql:dbname=" . DBNAME . "; host=" . DBHOST;
try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    // $db->setAttribute(attribute:PDO::FETCH_ASSOC);
    $db->exec("SET NAMES utf8");
   
} catch (PDOException $e) {
    die($e->getMessage());
  
}
?>