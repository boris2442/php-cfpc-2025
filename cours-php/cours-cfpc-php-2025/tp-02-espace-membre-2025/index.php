<?php
require_once "database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function clean_input($data)
    {
        // $data = trim($data);
        // $data2 = stripslashes($data);
        // $data_result = htmlspecialchars($data2);
        // return $data_result;
        return (htmlspecialchars(stripslashes(trim($data))));
    }

    //recuperation des donnees du formulaires
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = htmlspecialchars(trim($_POST['mdp']));
    $mdp2 = $_POST['mdp2'];

    function register($pseudo, $mail, $mail2, $mdp, $mdp2)
    {
        global $db;
        //verification des champs
        if (empty($pseudo) || empty($mail) || empty($mail2) || empty($mdp) || empty($mdp2)) {
            return "Tous les champs doivent etre remplis";
        }
        //verification de la longueur du pseudo
        if (strlen($pseudo) > 255) {
            return "Votre pseudo ne doit pas depasser 255 caracteres";
        }
        $sql = "SELECT * FROM membres WHERE pseudo = :pseudo";
        $reqPseudo = $db->prepare($sql);
        $reqPseudo->execute(compact('pseudo'));
        $pseudoExist = $reqPseudo->fetch();
        if ($pseudoExist) {
            return "Ce pseudo est deja utilisé";
        }
        //verification du mail
        if ($mail != $mail2) {
            return "Les mails ne correspondent pas";
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return "Votre mail n'est pas valide";
        }
        $sql = "SELECT * FROM `membres` WHERE mail=:mail";
        $reqMail = $db->prepare($sql);
        $reqMail->execute(compact('mail'));
        $mailExist = $reqMail->fetch();
        if ($mailExist) {
            return "Ce mail est déja utilisé";
        }
        //verification du mot de passe
        if ($mdp != $mdp2) {
            return "Les mots de passe ne correspondent pas";
        }
        //verification de langueur du mot de passe et verification si elle inclut les lettres, les chiffres, et les caracteres speciaux
        //if(strlen($mdp<8) || !preg_match("#[0-9]+#", $mdp)|| !preg_match("#[a-zA-Z])"))
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/', $mdp)) {
            return "👉Votre mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial";
        }
        //hashage du mot de passe
        $password_hash = password_hash($mdp, PASSWORD_ARGON2ID);
        //insertion des données dans la base de données
        $sql = "INSERT INTO membres(pseudo, mail, mdp) VALUES(:pseudo, :mail, :password_hash)";
        $req = $db->prepare($sql);
        $req->execute(compact('pseudo', 'mail', 'password_hash'));
        return "Votre compte a été créé avec succès... veuillez <a href=\'connexion.php\ class=' '>cliquez ici pour vous connectez</a>'";
        //redirection vers la page de connexion
        // header('Location: connexion.php');
        // exit;
    }
    //verification de la validité de l'adresse mail
    $error = register($pseudo, $mail, $mail2, $mdp, $mdp2);
}
?>
<?php

require_once "header-and-footer/header.php";
?>


<h2 class="text-4xl font-bold text-green-900 text-center mb-6">Veuillez vous inscrire</h2>

<form method="POST" action="" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <div class="flex flex-col gap-[7px] pt-[7px]">
        <?php
        if (isset($error)) {
            echo '<p class="bg-red-500  border-green-300 p-2 rounded focus:outline-none focus:border-green-500 text-white font-bold">' . $error . '</p>';
        }

        ?>
        <div class="text-left flex flex-col gap-[7px]">
            <label for="pseudo" class="">Pseudo :</label>

            <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php echo $pseudo ?? ""  ?>" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>
        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail">Mail :</label>

            <input type="text" placeholder="Votre mail" id="mail" value="<?php echo $mail ?? ""  ?>" name="mail" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>
        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail2">Confirmation du mail :</label>

            <input type="text" value="<?php echo $mail2 ?? ""  ?>" placeholder="Confirmez votre mail"  id="mail2" name="mail2" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>
        <!-- <div class="text-left flex flex-col gap-[7px]">
                <label for="mdp">Mot de passe :</label>

                <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
            </div> -->
        <!-- <i class="far fa-facebook"></i> -->
        <div class="text-left flex flex-col gap-[7px]">
            <label for="mdp">Mot de passe :</label>
            <div class="relative">
                <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value="<?php echo $mdp ?? ""  ?>" />
                <!-- <i class="fa fa-eye absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i> -->
                <!-- <i class="far fa-eye absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i> -->
                <i class="fa-solid fa-eye  absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i>
            </div>
        </div>
        <div class="text-left flex flex-col gap-[7px]">
            <label for="mdp2">Confirmation du mot de passe :</label>

            <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value="<?php echo $mdp2 ?? ""  ?> " />
        </div>
        <div class="text-left flex flex-col gap-[7px]">
            <input type="submit" name="forminscription" value="S'inscrire" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
        </div>

        <div class="w-full text-left flex  gap-[7px] justify-between">
            <small class="border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100">Déjà un compte ? </small>

            <a
                href="connexion.php" class="border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100">Se connecter
            </a>
        </div>
    </div>
</form>


<script src="./javascript/script-index.js"></script>
<?php
require_once "./header-and-footer/footer.php";
?>