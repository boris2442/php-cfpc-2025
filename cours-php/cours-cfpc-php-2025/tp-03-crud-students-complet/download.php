<?php
require_once "database.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Requête pour récupérer le document
    $sql = "SELECT document FROM `users` WHERE id = :id";
    $requete = $db->prepare($sql);
    $requete->bindValue(':id', $id, PDO::PARAM_INT);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_ASSOC);

    if ($result && !empty($result['document'])) {
        var_dump($result['document']); // Vérifiez le contenu
        exit;
    } else {
        echo "Document introuvable ou vide.";
        exit;
    }
} else {
    echo "ID invalide.";
    exit;
}
