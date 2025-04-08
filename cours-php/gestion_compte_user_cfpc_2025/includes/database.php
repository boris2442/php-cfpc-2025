<?php 
 $servername = "127.0.0.1";
 $username = "root";
 $password = "";
 $database = "gestion_compte_user-cfpc-2025";
try {
     $db= new PDO("mysql:host=$servername;dbname=$database", $username, $password);
     // 2-Configurer le mode d'erreur pour lancer des exceptions
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //  3-echo "<div style='background-color:#3c763d; color:white;'>Connexion à la base de donnée réussie</div>";
     
 } catch(PDOException $e) {
     echo "<div style='color:red;'>La connexion à la base de données a échoué :</div> " . $e->getMessage();
 }
 ?>