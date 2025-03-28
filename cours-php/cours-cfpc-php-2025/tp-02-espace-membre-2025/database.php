<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
// define("DBUSER", "postgresql");
define("DBPASS", "");
define("DBNAME", "tp-02-espace-membre-2025");


$dsn = "mysql:dbname=" . DBNAME . "; host=" . DBHOST;
try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $db->exec("SET NAMES utf8");
   
} catch (PDOException $e) {
    die($e->getMessage());
  
}
?>