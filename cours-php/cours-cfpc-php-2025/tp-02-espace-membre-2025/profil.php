<?php
session_start();
require_once "database.php";
?>

<?php
require_once "header-and-footer/header.php";
$title = "profil of user";
?>


<h2>Profil de: <?= $userinfo['pseudo']; ?></h2>

<h3><?= $userinfo['mail']; ?></h3>

<?php
if (isset($_SESSION['id']) && $userinfo['id'] == $_SESSION['id']) {
?>
    <div>
        <a href="editionprofil.php">Editer mon profil</a>
    </div>
    <div>
        <a href="deconnexion.php">Se déconnecter</a>
    </div>
<?php
} else {
    echo '<br />Vous ne pouvez pas accéder à ce profil';
}
?>

<?php
require_once "header-and-footer/footer.php";
?>