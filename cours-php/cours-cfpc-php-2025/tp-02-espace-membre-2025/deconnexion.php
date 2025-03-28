<?php
//deconnexion de l'utilisateur
session_start();
$_SESSION = [];
session_destroy(); //destruction de la session 
header("location:connexion.php");
