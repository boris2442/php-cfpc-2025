<?php
session_start();
require_once "database.php"; // Ce fichier doit contenir la connexion PDO dans la variable $pdo

// Vérifier que l'ID est passé en GET et qu'il s'agit d'un nombre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    // Préparer et exécuter la suppression
    $smtp= $db->prepare("DELETE FROM membres WHERE id = ?");
    if ($smtp->execute([$id])) {
        $_SESSION['message'] = "Étudiant supprimé avec succès !";
    } else {
        $_SESSION['message'] = "Erreur lors de la suppression de l'étudiant.";
    }
}

// Redirection vers la page de gestion
header("Location: admindofjjzeee-dashbord.php");
exit;
?>