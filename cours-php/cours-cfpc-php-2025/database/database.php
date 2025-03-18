<?php
$hostname="127.0.0.1";
$username="root";
$password="";
$database="cours-cfpc-php-2025";
$connect=new mysqli(hostname:$hostname, username:$username, password:$password, database:$database);

if($connect->connect_error){
    echo "Erreur:mauvaise connexion a la database";
    $connect->connect_error;
}else{
    echo "Succes:connexion a la database reussie";
}



?>