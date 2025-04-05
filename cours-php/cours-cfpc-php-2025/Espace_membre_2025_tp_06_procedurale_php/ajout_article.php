<?php
// require_once "database.php";
// require "clean_input.php";
// session_start();


// $error = "";

// $id_utilisateur = $_SESSION['users']['id']; 
// var_dump($id_utilisateur);

// if (!empty($_POST)) {
//     if (
//         isset($_POST['article_title'], $_POST['article_content']) &&
//         !empty($_POST['article_title']) && !empty($_POST['article_content'])
//     ) {
//         $title = clean_input($_POST['article_title']);
//         $content = clean_input($_POST['article_content']);

//         if (strlen($title) > 50) {
//             $error = "Le titre de l'article ne doit pas dépasser 50 caractères.";
//         } elseif (strlen($content) > 240) {
//             $error = "Le contenu ne doit pas dépasser 240 caractères.";
//         } else {
//             $sql = "INSERT INTO `articles2` (`author`, `title`, `content`, `id_utilisateur`) 
//                     VALUES (:author_article, :title, :content_article, :id_utilisateur)";
//             $requete = $db->prepare($sql);
//             $requete->bindValue(':author_article', $_SESSION['users']['pseudo']); 
//             $requete->bindValue(':title', $title);
//             $requete->bindValue(':content_article', $content);
//             $requete->bindValue(':id_utilisateur', $id_utilisateur);
//             $requete->execute();
//         }
//     }
// }


// $sql = "SELECT articles2.*, utilisateurs.pseudo AS nom_auteur
//         FROM articles2
//         INNER JOIN utilisateurs ON articles2.id_utilisateur = utilisateurs.id
//         ORDER BY date DESC";
// $requete = $db->prepare($sql);
// $requete->execute();
// $articles = $requete->fetchAll(PDO::FETCH_ASSOC);



session_start();
require_once "database.php";
require "clean_input.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['users'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

$error = ""; // Initialisation de la variable d'erreur

$id_utilisateur = $_SESSION['users']['id']; // L'ID de l'utilisateur connecté
if (!empty($_POST)) {
    if (
        isset($_POST['article_title'], $_POST['article_content']) &&
        !empty($_POST['article_title']) && !empty($_POST['article_content'])
    ) {
        $title = clean_input($_POST['article_title']);
        $content = clean_input($_POST['article_content']);

        if (strlen($title) > 50) {
            $error = "Le titre de l'article ne doit pas dépasser 50 caractères.";
        } elseif (strlen($content) > 240) {
            $error = "Le contenu ne doit pas dépasser 240 caractères.";
        } else {
            // Insertion dans la base de données
            $sql = "INSERT INTO `articles2` (`author`, `title`, `content`, `id_utilisateur`) 
                    VALUES (:author_article, :title, :content_article, :id_utilisateur)";
            $requete = $db->prepare($sql);
            $requete->bindValue(':author_article', $_SESSION['users']['pseudo']); // Nom de l'utilisateur connecté
            $requete->bindValue(':title', $title);
            $requete->bindValue(':content_article', $content);
            $requete->bindValue(':id_utilisateur', $id_utilisateur);
            $requete->execute();
        }
    }
}

// Récupérer les articles avec jointure pour afficher le nom de l’auteur depuis la table utilisateurs
$sql = "SELECT articles2.*, utilisateurs.nom AS nom_auteur
        FROM articles2
        INNER JOIN utilisateurs ON articles2.id_utilisateur = utilisateurs.id
        ORDER BY date DESC";
$requete = $db->prepare($sql);
$requete->execute();
$articles = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
$title = "Ajouter un article";
require_once "header-and-footer/header.php";
?>
<div class="container grid grid-cols-2 md:grid-cols-2 gap-4 p-4">
    <div class="box-container">
        <h2 class="text-4xl font-bold text-green-900 text-center mb-6">Créer un article</h2>

        <form method="POST" action="" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
            <div class="flex flex-col gap-[7px] pt-[7px]">
                <?php if (!empty($error)) : ?>
                    <p class="bg-green-500 border-green-300 p-[9px] rounded focus:outline-none focus:border-green-500 text-white font-bold min-h-[30px]">
                        <?= $error ?>
                    </p>
                <?php endif; ?>

                <div class="text-left flex flex-col gap-[7px]">
                    <label for="title">Titre de l'article</label>
                    <input type="text" placeholder="Titre de l'article" id="title" name="article_title" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
                </div>

                <div class="text-left flex flex-col gap-[7px]">
                    <label for="mail">Contenu de l'article</label>
                    <textarea name="article_content" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 resize-none h-[150px]"></textarea>
                </div>

                <div class="text-left flex flex-col gap-[7px]">
                    <input type="submit" name="submit_article" value="Créer un article" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
                </div>
            </div>
        </form>
    </div>

    <div class="box-container bg-green-500 h-[500px] overflow-auto rounded-[7px]">
        <h2 class="text-4xl font-bold text-white text-center mb-6 uppercase p-[5px] ">Listes des articles</h2>
        <div class="flex gap-4 flex-wrap justify-center items-center">
            <?php foreach ($articles as $article): ?>
                <div class="w-[300px] h-[250px] bg-white p-4 rounded shadow mb-4 relative">
                    <h4 class="text-green-900 font-bold text-2xl">
                        <span class="">Title:</span> <?= clean_input($article['title']) ?>
                    </h4>
                    <h3 class=""><span class="text-green-900 font-bold">Auteur: </span><?= clean_input($article['nom_auteur']) ?></h3>
                    <h3 class=""><span class="text-green-900 font-bold">Contenu: </span><?= clean_input($article['content']) ?></h3>
                    <p class=""><span class="text-green-900 font-bold">Publié le : </span><?= clean_input($article['date']) ?></p>
                    <div class="flex justify-between items-center mt-4 absolute bottom-0 left-0 right-0">
                        <button class="bg-green-900 p-1 text-white hover:text-green-700">
                            <a href="delete.php?id=<?= $article['id'] ?>">Supprimer</a>
                        </button>
                        <button class="bg-green-900 p-1 text-white hover:text-green-700">
                            <a href="edit_article.php?id=<?= $article['id'] ?>">Modifier</a>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
require_once "header-and-footer/footer.php";
?>
