<?php
session_start();

// Supprimer tous les cookies
if (isset($_COOKIE['email'])) {
    setcookie('email', '', time() - 3600, "/"); // Supprime le cookie email
}

// Détruire la session
session_unset();
session_destroy();

// Rediriger vers la page de connexion
header("Location: connexion.php");
exit();
?>