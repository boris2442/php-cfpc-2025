<?php
session_start();
require_once "database.php";
if (isset($_GET['id'])) {

    $getid = intval($_GET['id']);
    $requser = $db->prepare('SELECT*FROM membres WHERE id=?');
    $requser->execute([$getid]);
    $userInfos = $requser->fetch();
}


?>






<?php
require_once "header-and-footer/header.php";
$title = "profil of user";
?>

<h1>Bienvenue sur profil!...</h1>

<h2>Profil de: <?= $userInfos['pseudo']; ?></h2>

<?php if (!empty($userinfo['avatar'])) { ?>
    <img src="membres/avatars/<?= $userinfo['avatar']; ?>" width="222">
<?php  } ?>





<h3>mail:<?= $userInfos['mail']; ?></h3>

<?php
if (isset($_SESSION['id']) && $userInfos['id'] == $_SESSION['id']) {
?>
    <div>
        <a href="editprofil.php">Editer mon profil</a>
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