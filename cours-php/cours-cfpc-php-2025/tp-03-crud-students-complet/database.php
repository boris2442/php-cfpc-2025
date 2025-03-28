<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBNAME", "tp-03-crud-students-complet");
define("DBPASS", "");
$dsn = "mysql:dbname=" . DBNAME . "; host=" . DBHOST;
try {
    $db = new PDO($dsn, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
}
