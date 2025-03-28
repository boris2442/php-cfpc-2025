<?php
session_start();
require_once "database.php";
if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
    $requser = $db->prepare("SELECT*FROM membres WHERE id=?");
    $requser->execute([$_SESSION['id']]);

    $user = $requser->fetch();
    // echo "<pre>";
    // var_dump($user);
    // echo "</pre>";
    if (!empty($_POST['newpseudo']) && $_POST['newpseudo'] !== $user['pseudo']) {
        $newspseudo = htmlspecialchars(trim($_POST['newpseudo']));
        if (strlen($newpseudo) < 255) {

            $updatepseudo = $db->prepare("SELECT*FROM membres  WHERE pseudo=?");
            $updatepseudo->execute([$newspseudo]);
            if ($updatepseudo->rowCount() == 0) {
                $updatepseudo = $db->prepare("UPDATE membres SET pseudo=? WHERE id=?");
                $updatepseudo->execute([$newspseudo, $_SESSION['id']]);
                $_SESSION['pseudo'] = $newspseudo;
                header('Location: profil.php?id=' . $_SESSION['id']);
            } else {
                $erreur = "Ce pseudo est déjà utilisé !";
            }
            // header('Location: profil.php?id='. $_SESSION['id']);
            // header('Location: profil.php?id=' . $_SESSION['id']);
        } else {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères!";
        }
    }
}




?>

<?php

require_once "header-and-footer/header.php";
?>




<div align="center">
    <h2>Edition de mon profil</h2>
    <?php
    if (isset($erreur)) {
        echo '<font color="red">' . $erreur . "</font>";
    }
    ?>
    <div align="left">
        <form method="POST" action="" enctype="multipart/form-data">
            <label>Pseudo :</label>
            <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo'] ?>" /><br /><br />
            <label>Mail :</label>
            <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail'] ?>" /><br /><br />
            <label>Mot de passe :</label>
            <input type="password" name="newmdp1" placeholder="Mot de passe" value="" /><br /><br />
            <label>Confirmation - mot de passe :</label>
            <input type="password" name="newmdp2" value='' placeholder="Confirmation du mot de passe" /><br /><br />
            <label for="">Avatar :</label>
            <input type="file" name="avatar" /><br /><br />
            <input type="submit" value="Mettre à jour mon profil !" />
        </form>
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
    </div>
</div>
</body>

</html>