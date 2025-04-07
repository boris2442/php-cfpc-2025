<?php
session_start();

require_once "database.php";
require "clean_input.php";

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['users']['id']) && $_SESSION['users']['id'] > 0) {
    // Récupérer les informations de l'utilisateur depuis la base de données
    $requser = $db->prepare("SELECT * FROM `utilisateurs` WHERE id=?");
    $requser->execute([$_SESSION['users']['id']]);
    $user = $requser->fetch();

    // Stocker les informations utilisateur dans la session
    $_SESSION['users'] = [
        'id' => $user['id'],
        'pseudo' => $user['pseudo'],
        'email' => $user['email'],
        'avatar' => $user['avatar'],
        'password' => $user['password'], // Attention : Ne pas afficher le mot de passe
    ];

    // Mise à jour du pseudo
    if (!empty($_POST['newspseudo'])) {
        $newspseudo = clean_input($_POST['newspseudo']);
        if (strlen($newspseudo) < 255) {
            $updatepseudo = $db->prepare("SELECT * FROM `utilisateurs` WHERE pseudo=?");
            $updatepseudo->execute([$newspseudo]);
            if ($updatepseudo->rowCount() == 0) {
                $updatepseudo = $db->prepare("UPDATE utilisateurs SET pseudo=? WHERE id=?");
                $updatepseudo->execute([$newspseudo, $_SESSION['users']['id']]);
                $_SESSION['users']['pseudo'] = $newspseudo; // Mettre à jour le pseudo dans la session
            }
        } else {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères!";
        }
    }

    // Mise à jour du mail
    if (!empty($_POST['newmail']) && $_POST['newmail'] !== $user['email']) {
        $newemail = clean_input($_POST['newmail']);
        if (filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
            $updatemail = $db->prepare("SELECT * FROM utilisateurs WHERE email=?");
            $updatemail->execute([$newemail]);
            if ($updatemail->rowCount() == 0) {
                $updatemail = $db->prepare("UPDATE utilisateurs SET mail=? WHERE id=?");
                $updatemail->execute([$newemail, $_SESSION['users']['id']]);
                $_SESSION['users']['email'] = $newemail; // Mettre à jour le mail dans la session
            } else {
                $erreur = "Cette adresse mail est déjà utilisée!";
            }
        } else {
            $erreur = "Votre adresse mail n'est pas valide!";
        }
    }

    // Mise à jour du mot de passe
    if (!empty($_POST['newmdp1']) && isset($_POST['newmdp1'])) {
        $mdp1 = clean_input($_POST['newmdp1']);
        if ($mdp1) {
            $mdp = password_hash($mdp1, PASSWORD_DEFAULT);
            $updatemdp = $db->prepare("UPDATE utilisateurs SET password=? WHERE id=?");
            $updatemdp->execute([$mdp, $_SESSION['users']['id']]);
            // Mettre à jour le mot de passe dans la session
            $_SESSION['users']['password'] = $mdp;
        } else {
            $erreur = "Les deux mots de passe ne correspondent pas!";
        }
    } else {
        $erreur = "Veuillez renseigner tous les champs!";
    }

    // Mise à jour de l'avatar
    if (!empty($_FILES['avatar']['name'])) {
        $maxsize = 2 * 1024 * 1024;  // 2MB
        $valideExtension = ['jpg', 'png', 'gif', 'jpeg'];

        if ($_FILES['avatar']['size'] <= $maxsize) {
            $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $valideExtension)) {
                $newFilename = $_SESSION['users']['id'] . "." . $ext;
                $destination = "membres/avatars/" . $newFilename;
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $destination)) {
                    $requpdate = $db->prepare("UPDATE utilisateurs SET avatar=? WHERE id=?");
                    $requpdate->execute([$newFilename, $_SESSION['users']['id']]);
                    $_SESSION['users']['avatar'] = $newFilename; // Mettre à jour l'avatar dans la session
                    header('Location: profil.php?id=' . $_SESSION['users']['id']);
                    exit();
                } else {
                    $erreur = "Erreur lors de l'upload";
                }
            } else {
                $erreur = "Format d'image non autorisé. ('jpg', 'png', 'gif', 'jpeg' requis)";
            }
        } else {
            $erreur = "La taille de l'image ne doit pas dépasser 2 Mo";
        }
    } else {
        $erreur = "Veuillez sélectionner une image";
    }
}
?>

<?php
require_once "header-and-footer/header.php";
require_once "navbar.php";
?>

<div align="center">
    <h2 class="text-3xl font-bold">Édition de mon profil</h2>
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
                    <input type="text" name="newspseudo" placeholder="Pseudo" class="border-2 border-solid border-green-500 p-[5px] w-[350px] rounded-[5px]" value="<?php echo $_SESSION['users']['pseudo'] ?>" />
                </div>
                <div class="mx-auto w-[400px] flex flex-col gap-[10px]">
                    <label>Mail :</label>
                    <input type="text" name="newmail" class="border-2 border-solid border-green-500 p-[5px] w-[350px] rounded-[5px]" placeholder="Mail" value="<?php echo $_SESSION['users']['email'] ?>" />
                </div>
                <div class="mx-auto w-[400px] flex flex-col gap-[10px]">
                    <label>Mot de passe :</label>
                    <input type="password" name="newmdp1"  class="border-2 border-solid border-green-500 p-[5px] w-[350px] rounded-[5px]" placeholder="Mot de passe" value="" />
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
