<?php
require_once "database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `articles2` WHERE id=:id";
    $requete = $db->prepare($sql);
    $requete->bindValue(':id', $id);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $article_title = $result['title'];
        $author_article = $result['author'];
        $article_content = $result['content'];
    } else {
        echo "Aucun article trouvé.";
    }
} else {
    echo "Aucun identifiant trouvé.";
}

if(isset($_POST['submit_article'])){
    $article_title = $_POST['article_title'];
    $author_article = $_POST['author_article'];
    $article_content = $_POST['article_content'];
    $error ="";
    if(empty($article_title) || empty($author_article) || empty($article_content)){
        $error = "Veuillez remplir tous les champs";
    }else{
        $sql = "UPDATE `articles2` SET `title`=:article_title, `author`=:author_article, `content`=:article_content WHERE id=:id";
        $requete = $db->prepare($sql);
        $requete->bindValue(':id', $id);
        $requete->bindValue(':article_title', $article_title);
        $requete->bindValue(':author_article', $author_article);
        $requete->bindValue(':article_content', $article_content);
        if($requete->execute()){
            header("Location:ajout_article.php");
            exit();
        }else{
            echo "Erreur lors de la mise à jour de l'article.";
        }
    }
}





?>



<?php
require_once "header-and-footer/header.php";
?>
<h2 class="text-4xl font-bold text-green-900 text-center mb-6">editer un article</h2>

<form method="POST" action="" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <div class="flex flex-col gap-[7px] pt-[7px]">
        <?php if (!empty($error)) : ?>
            <p class="bg-green-500 border-green-300 p-[9px] rounded focus:outline-none focus:border-green-500 text-white font-bold min-h-[30px]">
                <?= $error ?>
            </p>
        <?php endif; ?>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="title">Titre de l'article</label>
            <input type="text" placeholder="Title of article" id="title" name="article_title" value="<?=   $article_title?>" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>
        <div class="text-left flex flex-col gap-[7px]">
            <label for="auteur">Auteur de l'aticle</label>
            <input type="text" placeholder="Boris La menace" id="auteur" name="author_article" value="<?=$author_article?>" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail">Contenu de l'article</label>
            <textarea name="article_content" id="" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 resize-none h-[150px]"></textarea>
            <!-- <div class="text-left flex flex-col gap-[7px]">
                <label for="image_article">image de l'article</label>
                <input type="file" placeholder="Title of article" id="image_article" name="image_article" value="" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
            </div> -->

        </div>


        <div class="text-left flex flex-col gap-[7px]">
            <input type="submit" name="submit_article" value="editer un article" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
        </div>


    </div>
</form>

<?php
require_once "header-and-footer/header.php";
?>