<?php
session_start();
require_once "database.php";

// Vérifie si l'utilisateur est connecté et s'il a le rôle 'admin'
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
echo "Accès refusé. Vous n'avez pas l'autorisation de supprimer cet article.";
    exit();
}



if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM `articles2` WHERE id=:id";
    $requete = $db->prepare($sql);
    $requete->bindValue(':id', $id);
    $requete->execute();
    header("Location:ajout_article.php");
    exit();
}
else{
    echo "Aucun identifiant trouvé.";
}

?>

