<?php
session_start();
require_once "database.php";

// Vérification si l'ID est passé en paramètre et s'il est valide
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo '<p class="text-red-500">ID invalide.</p>';
    exit();
}

$getid = intval($_GET['id']);

// Récupération des informations de l'utilisateur
$requser = $db->prepare('SELECT * FROM `utilisateurs` WHERE id = ?');
$requser->execute([$getid]);
$userInfos = $requser->fetch();

// Vérifier si l'utilisateur existe dans la base de données
if (!$userInfos) {
    echo '<p class="text-red-500">Utilisateur introuvable.</p>';
    exit();
}

// Vérification si l'utilisateur connecté tente d'accéder à son propre profil
if (isset($_SESSION['users']) && $_SESSION['users']['id'] == $userInfos['id']) {
    // Affichage des informations de profil
    $title = "Profil de l'utilisateur";
    require_once "header-and-footer/header.php";
    require_once "navbar.php";
?>

    <div class="max-w-[400px] bg-white mx-auto min-h-[350px] rounded-[7px] px-[7px] flex flex-col justify-center items-center mt-[12vh]  shadow-lg">
        <h1 class="text-center text-3xl p-[7px] font-bold text-green-900">Bienvenue sur ton profil !</h1>

        <h2 class="text-2xl font-bold">Profil de : <span class="text-2xl"><?= htmlspecialchars($userInfos['pseudo']); ?></span></h2>

        <h3 class="font-bold text-2xl">Email : <?= htmlspecialchars($userInfos['email']); ?></h3>
        <h3 class="font-bold text-2xl">Rôle : <?= htmlspecialchars($userInfos['roles']); ?></h3>
        <?php if (!empty($userInfos['avatar'])) { ?>
            <img src="membres/avatars/<?= htmlspecialchars($userInfos['avatar']); ?>" alt="Avatar de <?= htmlspecialchars($userInfos['pseudo']); ?>" class="w-[200px] h-[200px] object-cover bg-red-500" />
        <?php } ?>
        
    </div>

<?php
    require_once "header-and-footer/footer.php";
} else {
    echo '<p class="text-red-500">Vous ne pouvez pas accéder à ce profil.</p>';
    exit();
}
?>