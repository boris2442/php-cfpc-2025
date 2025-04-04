<?php
require_once "database.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM `articles2` WHERE id=:id";
    $requete = $db->prepare($sql);
    $requete->bindValue(':id', $id);
    $requete->execute();
    header("Location:ajout_article.php");
    exit();
}
else{
    echo "Aucun identifiant trouvé.";
}

?>