<?php
session_start();
require_once "database.php";

// Supprimer le cookie "remember_me" si présent
if (isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, "/", "", false, true); // Expire immédiatement

    // Supprimer aussi le token en base de données pour éviter une reconnexion automatique
    if (isset($_SESSION['id'])) {
        $requser = $db->prepare('UPDATE utilisateurs SET remember_token = NULL WHERE id = ?');
        $requser->execute([$_SESSION['id']]);
    }
}

// Détruire la session
session_unset();
session_destroy();

// Rediriger vers la page de connexion
header("Location: login.php");
exit();
