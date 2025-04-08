<?php
if (!empty($_POST)) {
    if (isset($_POST['comment_content']) && !empty($_POST['comment_content'])) {
        $comment_content = htmlspecialchars(trim($_POST['comment_content']));
        $article_id = $_POST['article_id'];
        $user_id = $_SESSION['id'];

        $sql = "INSERT INTO comments (content, article_id, user_id) VALUES (:content, :article_id, :user_id)";
        $requete = $db->prepare($sql);
        $requete->bindValue(':content', $comment_content);
        $requete->bindValue(':article_id', $article_id);
        $requete->bindValue(':user_id', $user_id);

        if ($requete->execute()) {
            echo "Commentaire ajouté avec succès!";
        } else {
            echo "Erreur lors de l'ajout du commentaire.";
        }
    } else {
        echo "Veuillez remplir le champ de commentaire.";
    }
}
