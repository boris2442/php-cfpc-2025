<?php
require_once "database.php";
?>

<?php
require_once "header-and-footer/header.php";
$title = "profil of user";
?>

<div align="center">
    <h2>Profil de <?= $userinfo['pseudo']; ?></h2>
    <br />

    <?php if (!empty($userinfo['avatar'])) { ?>
        <img src="membres/avatars/<?= $userinfo['avatar']; ?>" width="222">
    <?php  } ?>

    <h3><?= $userinfo['mail']; ?></h3>
    <br />

    <?php
    if (isset($_SESSION['id']) && $userinfo['id'] == $_SESSION['id']) {
    ?>
        <br />
        <a href="editionprofil.php">Editer mon profil</a>
        <a href="deconnexion.php">Se déconnecter</a>

    <?php
    } else {
        echo '<br />Vous ne pouvez pas accéder à ce profil';
    }
    ?>

</div>








<?php
require_once "header-and-footer/footer.php";
?>