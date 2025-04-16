<?php
if ($_POST) {
    if (!empty($_POST['article_id'])) {
        session_start();
        require_once "database.php";
        $article_id = (int) $_POST['article_id'];
        $user_id = $_SESSION['users']['id'] ?? null;

        if ($user_id) {
            // Vérifie si déjà liké
            $check = $db->prepare("SELECT * FROM likes_article WHERE user_id = :user_id AND article_id = :article_id");
            $check->execute([
                ':user_id' => $user_id,
                ':article_id' => $article_id
            ]);

            if ($check->rowCount() === 0) {
                // Nouveau like
                $insert = $db->prepare("INSERT INTO likes_article (user_id, article_id) VALUES (:user_id, :article_id)");
                $insert->execute([
                    ':user_id' => $user_id,
                    ':article_id' => $article_id
                ]);
            } else {
                // Retirer le like
                $delete = $db->prepare("DELETE FROM likes_article WHERE user_id = :user_id AND article_id = :article_id");
                $delete->execute([
                    ':user_id' => $user_id,
                    ':article_id' => $article_id
                ]);
            }

            // Redirection propre
            // echo "article ajoute";
         
            header("Location: http://localhost/php-2025/cours-php/cours-cfpc-php-2025/Espace_membre_2025_tp_06_procedurale_php/ajout_article4.php?id=$article_id");
   
            // exit();
        } else {
            echo "Erreur : Utilisateur non connecté.";
        }
    } else {
        echo "Erreur : ID d'article manquant.";
    }
}
