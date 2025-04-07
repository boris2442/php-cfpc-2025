<?php
session_start();
require_once "database.php";


var_dump($_POST['article_id']);
if (!isset($_SESSION['users']['id'])) {
    echo "Utilisateur non connecté.<br>";
    exit();
}

if (isset($_POST['article_id']) && is_numeric($_POST['article_id'])) {
    echo "Article ID reçu : " . $_POST['article_id'] . "<br>";

    $article_id = intval($_POST['article_id']);
    $user_id = $_SESSION['users']['id'];

    // Vérifie si l'utilisateur a déjà liké cet article
    $check = $db->prepare("SELECT * FROM likes WHERE user_id = ? AND article_id = ?");
    $check->execute([$user_id, $article_id]);

    if ($check->rowCount() == 0) {
        $insert = $db->prepare("INSERT INTO likes (user_id, article_id) VALUES (?, ?)");
        if ($insert->execute([$user_id, $article_id])) {
            echo "Like enregistré.<br>";
        } else {
            echo "Erreur lors de l'enregistrement du like.<br>";
        }
    } else {
        echo "Déjà liké.<br>";
    }
    
} else {
    echo "Aucun article ID valide reçu.<br>";
}
