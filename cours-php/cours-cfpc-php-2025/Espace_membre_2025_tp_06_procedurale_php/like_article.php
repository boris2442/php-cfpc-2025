<?php
session_start();
require_once "database.php";
echo "Méthode utilisée : " . $_SERVER["REQUEST_METHOD"] . "<br>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $article_id = isset($_POST['article_id']) ? (int) $_POST['article_id'] : null;
    $user_id = $_SESSION['users']['id'] ?? null;

    if ($user_id && $article_id) {
        // Vérifie si déjà liké
        $check = $db->prepare("SELECT * FROM likes WHERE user_id = :user_id AND article_id = :article_id");
        $check->execute([
            ':user_id' => $user_id,
            ':article_id' => $article_id
        ]);

        if ($check->rowCount() === 0) {
            // Nouveau like
            $insert = $db->prepare("INSERT INTO likes (user_id, article_id) VALUES (:user_id, :article_id)");
            $insert->execute([
                ':user_id' => $user_id,
                ':article_id' => $article_id
            ]);
        } else {
            // Retirer le like
            $delete = $db->prepare("DELETE FROM likes WHERE user_id = :user_id AND article_id = :article_id");
            $delete->execute([
                ':user_id' => $user_id,
                ':article_id' => $article_id
            ]);
        }

        // Redirection propre
        header("Location: index.php");
        exit;
    } else {
        echo "Erreur : Utilisateur non connecté ou ID d'article manquant.";
    }
} else {
    echo "Requête invalide.";
}
