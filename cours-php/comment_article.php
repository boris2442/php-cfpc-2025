<?php
session_start();

require_once "database.php";

$error='';
if($_POST){
    var_dump($_POST);
}

if(!empty($_POST)){
    if(isset($_POST['comment_content'], $_POST['article_id']) && !empty($_POST['comment_content']) && !empty($_POST['article_id'])){
        $comment_content = htmlspecialchars(trim($_POST['comment_content']));
        $article_id = intval($_POST['article_id']);
        $user_id = $_SESSION['users']['id'];
        var_dump($user_id, $article_id, $comment_content);
    }else{
        $error= "Veuillez remplir tous les champs.";
        exit;
    }
    if(empty($user_id)){
       $error="Erreur : utilisateur non connecté.";
        exit;
    }
    if($error===''){
        $sql="INSERT INTO comments (content, article_id, user_id) VALUES (:content, :article_id, :user_id)";
        $requete = $db->prepare($sql);
      
        $requete->bindValue(':content', $comment_content);
        $requete->bindValue(':article_id', $article_id);
        $requete->bindValue(':user_id', $user_id);
        
        if($requete->execute()){
            echo "<script>alert('Commentaire ajouté avec succès!'); window.location.href='./cours-cfpc-php-2025/Espace_membre_2025_tp_06_procedurale_php/ajout_article4.php';</script>";
            exit;
        }else{
            $error="Erreur lors de l'ajout du commentaire.";
        }
    }

}




// if($_POST){
//     var_dump($_POST);
// }
// if (!empty($_POST)) {
//     if (isset($_POST['comment_content'], $_POST['article_id']) && !empty($_POST['comment_content']) && !empty($_POST['article_id'])) {
//         $comment_content = htmlspecialchars(trim($_POST['comment_content']));
//         $article_id = intval($_POST['article_id']);
//         $user_id = $_SESSION['users']['id'];
//         var_dump($user_id, $article_id, $comment_content);
//     }else{
//         echo "Veuillez remplir tous les champs.";
//         exit;
//     }
//     if (empty($user_id)) {
//         echo "Erreur : utilisateur non connecté.";
//         exit;
//     }
// }

//         try {
  
//             $sql = "INSERT INTO comments (content, article_id, user_id) VALUES (:content, :article_id, :user_id)";
//             $requete = $db->prepare($sql);
//             $requete->bindValue(':content', $comment_content);
//             $requete->bindValue(':article_id', $article_id);
//             $requete->bindValue(':user_id', $user_id);

//             if ($requete->execute()) {
//                 echo "<script>alert('Commentaire ajouté avec succès!'); window.location.href='ajout_article4.php';</script>";
//                 exit;
//             } else {
//                 echo "Erreur lors de l'ajout du commentaire.";
//             }
//         } catch (PDOException $e) {
//             echo "Erreur SQL : " . $e->getMessage();
//             exit;
//         }
//     } else {
//         echo "Veuillez remplir tous les champs.";
//     }
// } else {
//     echo "Aucune donnée reçue.";
// }
// var_dump($_SESSION['users']);





