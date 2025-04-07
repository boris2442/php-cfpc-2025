<?php
session_start();
require_once "database.php";

// Vérifie si l'utilisateur est connecté et s'il a le rôle 'admin'
if (!isset($_SESSION['users']) || $_SESSION['users']['roles'] !== 'admin') {
    echo "Accès refusé. Vous n'avez pas l'autorisation de supprimer cet article.";
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];  

    // Vérifier si l'article existe
    $sqlCheck = "SELECT * FROM `articles2` WHERE id = :id";
    $requeteCheck = $db->prepare($sqlCheck);
    $requeteCheck->bindValue(':id', $id);
    $requeteCheck->execute();

    if ($requeteCheck->rowCount() > 0) {
        // Préparer et exécuter la requête de suppression
        $sql = "DELETE FROM `articles2` WHERE id = :id";
        $requete = $db->prepare($sql);
        $requete->bindValue(':id', $id);

        if ($requete->execute()) {
            // Si la suppression est réussie, redirige vers la page de gestion des articles
            header("Location: ajout_article4.php");  // Redirection vers la page de gestion des articles
            exit();
        } else {
            echo "Erreur lors de la suppression de l'article. Veuillez réessayer.";
        }
    } else {
        echo "L'article que vous tentez de supprimer n'existe pas.";
    }
} else {
    echo "Identifiant d'article invalide.";
}
?>
