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
    }
    $error = register($pseudo, $mail, $mail2, $mdp, $mdp2);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
    <title>Document</title>
</head>

<body>
    <div align="center">
        <h2>Inscription prof</h2>
        <br /><br />
        <form method="POST" action="">
            <?php
            if (isset($error)) {
                echo '<p style="white: red;background:red; padding:12px">' . $error . '</p>';
            }





            ?>
            <table>
                <tr>
                    <td align="right">
                        <label for="pseudo">Pseudo :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" />

                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail">Mail :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre mail" id="mail" name="mail" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail2">Confirmation du mail :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Confirmez votre mail" id="mail2" name="mail2" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp">Mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp2">Confirmation du mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">
                        <br />

                        <input type="submit" name="forminscription" value="Je m'inscris" /> Déjà un compte ?<a
                            href="connexion.php">Se connecter</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</body>

</html>