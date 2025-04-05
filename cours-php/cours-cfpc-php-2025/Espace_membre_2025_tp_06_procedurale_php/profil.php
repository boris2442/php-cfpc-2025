<?php
session_start();
require_once "database.php";

// Vérifier si l'ID est valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<p class="text-red-500">ID invalide.</p>';
    exit();
}

$getid = intval($_GET['id']);

// Récupérer les informations de l'utilisateur
$requser = $db->prepare('SELECT * FROM `utilisateurs` WHERE id = ?');
$requser->execute([$getid]);
$userInfos = $requser->fetch();

// Vérifier si l'utilisateur existe
if (!$userInfos) {
    echo '<p class="text-red-500">Utilisateur introuvable.</p>';
    exit();
}
?>

<?php
$title = "Profil de l'utilisateur";
require_once "header-and-footer/header.php";
?>

<div class="max-w-[400px] bg-white mx-auto min-h-[350px] rounded-[7px] px-[7px] flex flex-col justify-center items-center">
    <h1 class="text-center text-3xl p-[7px] font-bold text-green-900">Bienvenue sur ton profil !</h1>

    <h2 class="text-2xl font-bold">Profil de : <span class="text-2xl"><?= htmlspecialchars($userInfos['pseudo']); ?></span></h2>

    <h3 class="font-bold text-2xl">Email : <?= htmlspecialchars($userInfos['email']); ?></h3>

    <?php if (!empty($userInfos['avatar'])) { ?>
        <img src="membres/avatars/<?= htmlspecialchars($userInfos['avatar']); ?>" alt="Avatar de <?= htmlspecialchars($userInfos['pseudo']); ?>" class="w-[200px] h-[200px] object-cover bg-red-500" />
    <?php } ?>

    <?php if (isset($_SESSION['id']) && $userInfos['id'] == $_SESSION['id']) { ?>
        <div class="flex justify-between gap-[20px] pt-[20px] mx-auto">
            <div>
                <a href="editionprofil.php" class="bg-green-500 p-[5px] text-white rounded-[5px] hover:bg-900">Editer mon profil</a>
            </div>
            <div>
                <a href="deconnexion.php" class="bg-green-500 text-white p-[5px] rounded-[5px] hover:bg-900">Se déconnecter</a>
            </div>
            <div>
                <a href="ajout_article.php" class="bg-green-500 text-white p-[5px] rounded-[5px] hover:bg-900">Article</a>
            </div>
        </div>
    <?php } else { ?>
        <p class="text-red-500">Vous ne pouvez pas accéder à ce profil.</p>
    <?php } ?>
</div>

<?php
require_once "header-and-footer/footer.php";
?>