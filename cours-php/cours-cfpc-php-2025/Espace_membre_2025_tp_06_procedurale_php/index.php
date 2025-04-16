<?php
session_start();

?>
<?php
$title = "Ajouter un article";
require_once "header-and-footer/header.php";
?>

<!-- navbar.php (à inclure dans tes pages) -->


<?php require_once "navbar.php" ?>

<section class="min-h-screen flex flex-col md:flex-row items-center justify-center px-6 py-12 bg-green-50">
    <!-- Texte -->
    <div class="md:w-1/2 text-center md:text-left mb-10 md:mb-0">
        <h1 class="text-4xl md:text-5xl font-bold text-green-600 mb-4">Bienvenue !</h1>
        <p class="text-gray-700 text-lg mb-6">
            Ce site vous permet de découvrir des articles, d’interagir avec la communauté et bien plus encore. Restez curieux !
        </p>
        <a href="/ajout_article4.php" class="inline-block bg-green-600 text-white px-6 py-3 rounded-full text-lg hover:bg-green-700 transition mb-4">

            Découvrir
        </a>
    </div>

    <!-- Image -->
    <div class="md:w-1/2 flex justify-center">
      
        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb" alt="Nature verte" class="rounded-xl shadow-lg w-full max-w-md">
    </div>
</section>

<?php
require_once "header-and-footer/footer.php";
?>