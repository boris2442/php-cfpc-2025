<?php
require_once "database.php";
session_start();
if (!empty($_POST)) {
    if (isset($_POST['comment_content']) && !empty($_POST['comment_content'])) {
        $comment_content = clean_input($_POST['comment_content']);
        $article_id = $_POST['article_id'];
        $user_id = $_SESSION['users']['id'];
     

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
    } else {
        echo "Veuillez remplir le champ de commentaire.";
    }

    header("location:ajout_article4.php");
}else{
    echo "veuillez remplir ce champ";
    // var_dump($article_id);
    $user_id = $_SESSION['users']['id'];
}
?>