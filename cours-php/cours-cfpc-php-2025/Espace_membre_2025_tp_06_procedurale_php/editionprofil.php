<?php
session_start();
require_once "database.php";
require "clean_input.php";


if (isset($_SESSION['id']) and $_SESSION['id'] > 0) {
    $requser = $db->prepare("SELECT*FROM `utilisateurs` WHERE id=?");
    $requser->execute([$_SESSION['id']]);

    $user = $requser->fetch();
    var_dump($user);
    // echo "<pre>";
    // var_dump($user);
    // echo "</pre>";
    // if (!empty($_POST['newpseudo'])  !== $user['pseudo']) {
        $newspseudo =clean_input(($_POST['newspseudo']));
        if (strlen($newspseudo) < 255) {

            $updatepseudo = $db->prepare("SELECT*FROM `utilisateurs`   WHERE pseudo=?");
            $updatepseudo->execute([$newspseudo]);
            if ($updatepseudo->rowCount() == 0) {
                $updatepseudo = $db->prepare("UPDATE utilisateurs  SET pseudo=? WHERE id=?");
                $updatepseudo->execute([$newspseudo, $_SESSION['id']]);
                $_SESSION['pseudo'] = $newspseudo;
                // header('Location: profil.php?id=' . $_SESSION['id']);
            }
            // header('Location: profil.php?id='. $_SESSION['id']);
            // header('Location: profil.php?id=' . $_SESSION['id']);
        } else {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères!";
        }
    // }
    //mise a jour de l'email

    if (!empty($_POST['newmail']) && $_POST['newmail'] !== $user['mail']) {
        // $newemail = htmlspecialchars(trim($_POST['newmail']));
        $newemail = clean_input($_POST['newmail']);
        if (filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
            $updatemail = $db->prepare("SELECT*FROM utilisateurs  WHERE mail=?");
            $updatemail->execute([$newemail]);
            if ($updatemail->rowCount() == 0) {
                // $mdp = password_hash($_POST['newmdp1'], PASSWORD_DEFAULT);
                $updatemail = $db->prepare("UPDATE utilisateurs  SET mail=?WHERE id=?");
                $updatemail->execute([$newemail,  $_SESSION['id']]);
                $_SESSION['mail'] = $newemail;
                // header('Location: profil.php?id=' . $_SESSION['id']);
            } else {
                $erreur = "Cette adresse mail est déjà utilisée!";
            }
        } else {
            $erreur = "Votre adresse mail n'est pas valide!";

            // header('Location: profil.php?id='. $_SESSION['id']);
        }
    }
    //mise a jour du mot de passe

    if (
        !empty($_POST['newmdp1']) && isset($_POST['newmdp1']) 
    ) {
        // $mdp1 = htmlspecialchars(trim($_POST['newmdp1']));
        $mdp1 = clean_input($_POST['newmdp1']);
        // $mdp2 = clean_input($_POST['newmdp2']);
        // $mdp2 = htmlspecialchars(trim($_POST['newmdp2']));
        if ($mdp1) {
            $mdp = password_hash($mdp1, PASSWORD_DEFAULT);
            $updatemdp = $db->prepare("UPDATE utilisateurs SET mdp=? WHERE id=?");
            $updatemdp->execute([$mdp, $_SESSION['id']]);
            //
        } else {
            $erreur = "Les deux mots de passe ne correspondent pas!";
        }
    } else {
        $erreur = "Veuillez renseigner tous les champs!";
    }



    //mise a jour de l'avatar
    ////mise en avatar
    /** 
     * Mise de l'avatar 
      * 1 - Verification de l'upload de l'image
      * 2 - Verification de la taille de l'image
      * 3 - Verification de l'extension de l'image est autorisé
      * 4 - Renommer l'image uploadée (id de l'user 'extension de l'image)
      * 5 - Chemin de destination pour l'upload de l'image
      * 6 - Deplacement de l'image uploadée vers le dossier de destination
     * 
     * */
    //verificatin de la presence d'un fichier upload
    if (!empty($_FILES['avatar']['name'])) {
        $maxsize = 2 * 1024 * 1024;  // 2megaoctet
        ///tableau des extensiona autorises
        $valideExtension = ['jpg', 'png', 'gif', 'jpeg'];
        //verification de la taille de l'image
        if ($_FILES['avatar']['size'] <= $maxsize) {
            $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            //verification de l'extension des fichiers autorises
            if (in_array($ext, $valideExtension)) {
                //renommer l'image upploader(id de l'utilisateur.extension de l'image)
                $newFilename = $_SESSION['id'] . "." . $ext;

                //chemin de destination complete pour l'uppload de l'image
                $destination = "membres/avatars/" . $newFilename;
                if(move_uploaded_file($_FILES['avatar']['tmp_name'], $destination)){
                    $requpdate=$db->prepare("UPDATE membres SET avatar=? WHERE id=? ");
                    $requpdate->execute([$newFilename, $_SESSION['id']]);
                    header('Location: profil.php?id=' . $_SESSION['id']);
                    exit();
                    // $requpdate=$db->
                }else{
                    $erreur="Erreur lors de l'upload";
                }
            } else {
                $erreur = "format d'images non autoriser. ('.jpg', '.png', '.gif', '.jpeg' requis)";
            }
        } else {
            $erreur = "La taille de l'image ne doit pas exceder 2mo";
        }
        // 
    } else {
        $erreur = "Veuillez selectionner une image";
    }
}




?>

<?php

require_once "header-and-footer/header.php";
?>




<div align="center">
    <h2 class="text-3xl font-bold">Edition de mon profil</h2>
    <?php
    if (isset($erreur)) {
        echo '<font color="red">' . $erreur . "</font>";
    }
    ?>
    <div align="left">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="flex flex-col gap-[10px] w-[500px] bg-white mx-auto p-[12px] min-h-[500px] justify-center items-center">
                <div class="mx-auto w-[400px]  flex flex-col gap-[10px]">
                    <label>Pseudo :</label>
                    <input type="text" name="newspseudo" placeholder="Pseudo" class="border-2 border-solid border-green-500 p-[5px] w-[350px] rounded-[5px]" value="<?php echo $user['pseudo'] ?>" />
                </div>
                <div class="mx-auto w-[400px] flex flex-col gap-[10px]">
                    <label>Mail :</label>
                    <input type="text" name="newmail" class="border-2 border-solid border-green-500 p-[5px] w-[350px] rounded-[5px]" placeholder="Mail" value="<?php echo $user['email'] ?>" />
                </div>
                <div class="mx-auto w-[400px] flex flex-col gap-[10px]">
                    <label>Mot de passe :</label>
                    <input type="password" name="newmdp1"  class="border-2 border-solid border-green-500 p-[5px] w-[350px] rounded-[5px]"  placeholder="Mot de passe"  value="$user['password']" />
                </div>
               
                <div class="mx-auto w-[400px] flex flex-col gap-[10px]">
                    <label for="">Avatar :</label>            
                    <input type="file" name="avatar" />
                </div>
                <div class="mx-auto w-[400px]">
                    <input type="submit" class="border-2 border-solid border-green-500 p-[5px] w-[350px] rounded-[5px] bg-green-500 text-white " value="Mettre à jour mon profil !" />
                </div>
            </div>
        </form>

    </div>
</div>
</body>

</html>