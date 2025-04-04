

<?php
require_once "database.php";
require "clean_input.php";

$error = ""; // Initialisation de la variable d'erreur

if (!empty($_POST)) {
    if (
        isset($_POST['article_title'], $_POST['article_content'], $_POST['author_article']) &&
        !empty($_POST['article_title']) && !empty($_POST['article_content']) && !empty($_POST['author_article'])
    ) {
        $title = clean_input($_POST['article_title']);
        $content = clean_input($_POST['article_content']);
        $author = clean_input($_POST['author_article']);
        if(strlen($title)>50){
            $error="Le titre de l'article ne depasse pas 50 caracteres";
        }
        if(strlen($author)>50){
            $error="Le nom de l'auteur ne depasse pas 50 caracteres";
        }
        if(strlen($content)>240){
            $error="Le contenu ne doit pas deborder 240 caracters";
        }
        $sql="INSERT INTO `articles2` ( `author`,`title`, `name_article`,`content_article`) VALUES (:name_article, :author_article, :content_article)";
        $requete=$db->prepare($sql);
      
     
    }
}
?>





<?php
require_once "header-and-footer/header.php";
?>
<div class="container grid grid-cols-2 md:grid-cols-2 gap-4 p-4">
    <div class="box-container">
        <h2 class="text-4xl font-bold text-green-900 text-center mb-6">creer un article</h2>

        <form method="POST" action="" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
            <div class="flex flex-col gap-[7px] pt-[7px]">
                <?php if (!empty($error)) : ?>
                    <p class="bg-green-500 border-green-300 p-[9px] rounded focus:outline-none focus:border-green-500 text-white font-bold min-h-[30px]">
                        <?= $error ?>
                    </p>
                <?php endif; ?>

                <div class="text-left flex flex-col gap-[7px]">
                    <label for="title">Titre de l'article</label>
                    <input type="text" placeholder="Title of article" id="title" name="article_title" value="" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
                </div>
                <div class="text-left flex flex-col gap-[7px]">
                    <label for="auteur">Auteur de l'aticle</label>
                    <input type="text" placeholder="Boris La menace" id="auteur" name="author_article" value="" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
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
                    <input type="submit" name="submit_article" value="creer un article" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
                </div>


            </div>
        </form>
    </div>
    <div class="box-container bg-red-500">
        <h2 class="text-4xl font-bold text-green-900 text-center mb-6">Listes des articles</h2>
        <div class="">

        </div>
    </div>
</div>

<?php
require_once "header-and-footer/footer.php";
?>