<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['test'])) {
    $article_id = $_POST['test'] ?? '';
    // $content = trim($_POST['comment_content'] ?? '');

    var_dump($article_id);
    if (!empty($article_id)) {
        // Insérer le commentaire en BDD
    } else {
        echo "Champs requis manquants.";
    }
}else{
    echo "Aucune donnée reçue.";
}
