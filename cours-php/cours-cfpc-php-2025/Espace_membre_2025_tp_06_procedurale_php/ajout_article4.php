<?php


session_start();
// phpinfo();
require_once "database.php";
require "clean_input.php";


$error = "";

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['users']['pseudo'])) {
    $error = "Vous devez être connecté pour publier un article.";
} else {
    if (!empty($_POST)) {
        if (
            isset($_POST['article_title'], $_POST['article_content']) &&
            !empty($_POST['article_title']) && !empty($_POST['article_content'])
        ) {

            $title = clean_input($_POST['article_title']);
            $content = clean_input($_POST['article_content']);
            $author_article = $_SESSION['users']['pseudo']; // L'auteur est le pseudo connecté

            if (strlen($title) > 50) {
                $error = "Le titre de l'article ne doit pas dépasser 50 caractères.";
            } elseif (strlen($content) > 240) {
                $error = "Le contenu ne doit pas dépasser 240 caractères.";
            } else {
                $sql = "INSERT INTO `articles2` (`author`, `title`, `content`) VALUES (:author_article, :title, :content_article)";
                $requete = $db->prepare($sql);
                $requete->bindValue(':author_article', $author_article);
                $requete->bindValue(':title', $title);
                $requete->bindValue(':content_article', $content);
                $requete->execute();
            }
        }
    }
}

// Récupère la recherche
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Pagination : Nombre d'articles par page
$articlesPerPage = 4;

// Récupérer le numéro de la page actuelle (si aucun, la page 1 par défaut)
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startLimit = ($currentPage - 1) * $articlesPerPage;

// Préparer la requête avec ou sans recherche
////////////////////////

// $sql = "SELECT * FROM articles2";/////////////////////////////////////
$sql = "SELECT a.*, COUNT(l.id) AS like_count 
        FROM articles2 a 
        LEFT JOIN likes_article l ON a.id = l.article_id";
//////////////////
$params = [];

if (!empty($search)) {
    $sql .= " WHERE title LIKE :search OR content LIKE :search OR author LIKE :search";
    $params[':search'] = "%$search%";
}

// $sql .= " ORDER BY date DESC LIMIT :start, :limit";////////////////////////////
$sql .= " GROUP BY a.id ORDER BY date DESC LIMIT :start, :limit";

// Préparer et exécuter la requête avec la pagination
$requete = $db->prepare($sql);
$requete->bindValue(':start', $startLimit, PDO::PARAM_INT);
$requete->bindValue(':limit', $articlesPerPage, PDO::PARAM_INT);

if (!empty($search)) {
    $requete->bindValue(':search', $params[':search'], PDO::PARAM_STR);
}

$requete->execute();
$articles = $requete->fetchAll(PDO::FETCH_ASSOC);

// Récupérer le nombre total d'articles pour la pagination
$sqlCount = "SELECT COUNT(*) FROM articles2";
if (!empty($search)) {
    $sqlCount .= " WHERE title LIKE :search OR content LIKE :search OR author LIKE :search";
}

$requeteCount = $db->prepare($sqlCount);

if (!empty($search)) {
    $requeteCount->bindValue(':search', $params[':search'], PDO::PARAM_STR);
}

$requeteCount->execute();
$totalArticles = $requeteCount->fetchColumn();

// Calculer le nombre total de pages
$totalPages = ceil($totalArticles / $articlesPerPage);



// Pagination : Liens de pagination
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href='?page=$i&search=" . urlencode($search) . "'>$i</a> ";
}

?>

<?php
$title = "Ajouter un article";
require_once "header-and-footer/header.php";
?>
<?php require_once "navbar.php" ?>
<p class='pl-[16px] pb-[20px]'>Article disponible: <?= $totalArticles?></p>
<div class="container grid grid-cols-1 md:grid-cols-2 gap-4 p-4 mt-[40px] relative mx-auto">
    <!-- <div class="container grid grid-cols-[repeat(auto-fill,minmax(450px,1fr))] gap-4 p-4 "> -->
    <div class="box-container  bg-blue-400 h-[500px] overflow-auto rounded-[7px]">

        <h2 class="text-4xl font-bold text-white text-center mb-4 uppercase">creer un article</h2>
        <form method="POST" action="" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
            <div class="flex flex-col gap-[7px] pt-[7px]">
                <?php if (!empty($error)) : ?>
                    <p class="bg-red-500 text-white p-3 rounded"><?= $error ?></p>
                <?php endif; ?>

                <div class="text-left flex flex-col gap-[7px]">
                    <label for="title">Titre de l'article</label>
                    <input type="text" placeholder="Titre de l'article" id="title" name="article_title"
                        value="<?= htmlspecialchars($_POST['article_title'] ?? '') ?>" required
                        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
                </div>

                <div class="text-left flex flex-col gap-[7px]">
                    <label for="content">Contenu de l'article</label>
                    <textarea name="article_content" required
                        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 resize-none h-[150px]"><?= htmlspecialchars($_POST['article_content'] ?? '') ?></textarea>
                </div>

                <div class="text-left flex flex-col gap-[7px]">
                    <input type="submit" name="submit_article" value="Créer un article"
                        class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
                </div>
            </div>
        </form>
    </div>

    <div class="box-container bg-blue-400 h-auto md:h-[500px] md:overflow-auto   rounded-[7px] relative">
        <h2 class="text-4xl font-bold text-white text-center mb-6 uppercase p-[5px] sticky top-0 left-0 z-10">Listes des articles</h2>


        <form method="GET" class="bg-green-100 w-[450px] mx-auto my-[10px] rounded-full grid grid-cols-[60%_20%_20%] overflow-hidden sticky top-7 left-0 z-10">
            <input type="text" name="search" placeholder="Recherchez les articles par titre"
                class="p-[7px] border-none outline-none" />

            <input type="submit" value="Rechercher"
                class="bg-white text-[16px] font-semibold hover:bg-gray-200 cursor-pointer" />

            <a href="http://localhost/php-2025/cours-php/cours-cfpc-php-2025/Espace_membre_2025_tp_06_procedurale_php/"
                class="bg-green-100 text-center flex items-center justify-center text-[16px] font-semibold hover:bg-gray-200 cursor-pointer">
                Actualiser
            </a>
        </form>


        <div class="flex gap-4 flex-wrap justify-center items-center">
            <?php
            foreach ($articles as $article):
            ?>
                <div class="w-[300px] min-h-[300px]  bg-white p-4 rounded shadow mb-4 relative">

                    <h4 class="text-green-900  font-bold text-2xl"><span class="">Title:</span> <?= clean_input($article['title']) ?></h4>
                    <h3 class=""><span class="text-green-900  font-bold ">Auteur: </span><span class=""><?= clean_input($article['author'])   ?></span></h3>

                    <!-- Contenu -->

                    <h3 class=""><span class="text-green-900  font-bold">Contenu: </span><span class=""><?= clean_input($article['content']) ?></span> </h3>

                    <!-- Date -->

                    <p class=""><span class="text-green-900  font-bold">Publié le : </span> <span class=""><?= clean_input($article['date']) ?></span></p>

                    <span class="text-blue-600 font-bold">Likes : <?= htmlspecialchars($article['like_count'] ?? 0); ?></span>

                    <!-- Formulaire de commentaire -->
                                        <!-- Formulaire de commentaire -->
                    <?php if (isset($_SESSION['users'])): ?>
<!-- javascript formulaire commentaire,,,,,,,,,,,,,,,,, -->
                        <button onclick="document.getElementById('commentDialog').showModal()" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">
                            Laisser un commentaire
                        </button>
                        <dialog id="commentDialog" class="rounded p-4 w-full max-w-md absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white shadow-lg">

                            <form action="../../comment_article.php" method="POST" class="my-4 mx-auto ">
                                <input type="hidden" name="article_id" value="<?= $article['id'] ?>">

                                <textarea name="comment_content" placeholder="Laissez un commentaire..." class="w-full p-2 rounded border mb-2 resize-none"></textarea>

                                <input type="submit" value="Commenter" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700" name='commenter' />
                                <button type="button" class="bg-red-600 text-white px-4 py-1 rounded hover:bg-blue-700" onclick="document.getElementById('commentDialog').close()">Anuler</button>
                            </form>
                        </dialog>

                    <?php else: ?>
                        <p class="text-sm text-red-600 mt-2">Connectez-vous pour laisser un commentaire.</p>
                    <?php endif; ?>





                    <div class="flex justify-between items-center mt-4 absolute bottom-0 left-0 right-0">

                        <?php

                        if (isset($_SESSION['users']['roles']) && $_SESSION['users']['roles'] === 'admin') :

                        ?>
                            <button class="bg-blue-400 p-1 text-white hover:text-blue-100 hover:rounded-lg "><a href="edit_article.php?id=<?= $article['id'] ?>" class="">Modifier</a></button>
                        <?php
                        endif;
                        ?>
                        <form action="../../like_article.php" method="post">
                            <input type="hidden" name="article_id" value="<?= $article['id']; ?>">
                            <input type="submit" class="text-blue-600" value="👍 ❤️  
                             ( <?= $article['like_count']  ?? 0   ?>  )  ">






                        </form>

                        <?php

                        if (isset($_SESSION['users']['roles']) && $_SESSION['users']['roles'] === 'admin') :


                        ?>
                            <button class="bg-red-500 p-1 text-white ">
                                <a href="delete3.php?id=<?= $article['id'] ?>">Supprimer</a>
                            </button>
                        <?php
                        endif;
                        ?>

                    </div>

 






                </div>
            <?php endforeach; ?>

        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>" class="bg-green-500 text-white p-2 rounded">Précédent</a>
            <?php endif; ?>

            <span>Page <?= $currentPage ?> sur <?= $totalPages ?></span>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>" class="bg-green-500 text-white p-2 rounded">Suivant</a>
            <?php endif; ?>
        </div>
    </div>
</div>



<?php
require_once "header-and-footer/footer.php";
?>