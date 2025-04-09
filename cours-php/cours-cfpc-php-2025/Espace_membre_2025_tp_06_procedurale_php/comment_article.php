<?php
// Commentaire sur un article
require_once "database.php";
session_start();

if (!empty($_POST)) {
    if (isset($_POST['comment_content'], $_POST['article_id']) && !empty($_POST['comment_content']) && !empty($_POST['article_id'])) {
        $comment_content = htmlspecialchars(trim($_POST['comment_content']));
        $article_id = intval($_POST['article_id']);
        $user_id = $_SESSION['users']['id'];

        // Vérification des données
        if (empty($user_id)) {
            echo "Erreur : utilisateur non connecté.";
            exit;
        }

        try {
            // Insertion du commentaire dans la base de données
            $sql = "INSERT INTO comments (content, article_id, user_id) VALUES (:content, :article_id, :user_id)";
            $requete = $db->prepare($sql);
            $requete->bindValue(':content', $comment_content);
            $requete->bindValue(':article_id', $article_id);
            $requete->bindValue(':user_id', $user_id);

            if ($requete->execute()) {
                echo "<script>alert('Commentaire ajouté avec succès!'); window.location.href='ajout_article4.php';</script>";
                exit;
            } else {
                echo "Erreur lors de l'ajout du commentaire.";
            }
        } catch (PDOException $e) {
            echo "Erreur SQL : " . $e->getMessage();
            exit;
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
} else {
    echo "Aucune donnée reçue.";
}
// var_dump($_SESSION['users']);
