<?php
session_start();
if (isset($_COOKIE['email'])) {
    setcookie('email', '', time() - 3600, "/"); // Supprime le cookie email
}
unset($_SESSION['auth']);//supprime la variable de session auth
$_SESSION['flash']['success'] = "Vous êtes déconnecté avec succès !";
header('Location: login.php');//redirection de l'utilisateur vers la page de connexion




?>