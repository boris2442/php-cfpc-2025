<?php
require_once "database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //recuperation des donnees du formulaires
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = $_POST['mdp'];
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
    }
    //verification de la validité de l'adresse mail
    $error = register($pseudo, $mail, $mail2, $mdp, $mdp2);
}
?>
<?php
require_once "./header-and-footer/header.php";
?>

<div align="center">
    <h2 class="text-4xl font-bold text-green-900 text-center mb-6">Inscription prof</h2>

    <form method="POST" action="" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
        <div class="flex flex-col gap-[7px] pt-[7px]">
            <?php
            if (isset($error)) {
                echo '<p class="bg-red-500 w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 text-white font-bold">' . $error . '</p>';
            }

            ?>
            <div class="text-left flex flex-col gap-[7px]">
                <label for="pseudo" class="">Pseudo :</label>

                <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
            </div>
            <div class="text-left flex flex-col gap-[7px]">
                <label for="mail">Mail :</label>

                <input type="text" placeholder="Votre mail" id="mail" name="mail" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
            </div>
            <div class="text-left flex flex-col gap-[7px]">
                <label for="mail2">Confirmation du mail :</label>

                <input type="text" placeholder="Confirmez votre mail" id="mail2" name="mail2" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
            </div>
            <div class="text-left flex flex-col gap-[7px]">
                <label for="mdp">Mot de passe :</label>

                <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
            </div>
            <div class="text-left flex flex-col gap-[7px]">
                <label for="mdp2">Confirmation du mot de passe :</label>

                <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
            </div>
            <div class="text-left flex flex-col gap-[7px]">
                <input type="submit" name="forminscription" value="S'inscrire" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
            </div>
        </div>
        Déjà un compte ?<a
            href="connexion.php">Se connecter</a>

    </form>

</div>
<?php
require_once "./header-and-footer/footer.php";
?>