<?php
require_once "database.php";
$error = "";
require "clean_input.php";
if (!empty($_POST)) {
    if (
        isset($_POST['pseudo'], $_POST['email'], $_POST['password']) && isset($_POST['role'])
        && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])

    ) {
        $pseudo = clean_input($_POST['pseudo']);
        if (strlen($pseudo > 40)) {
            $error = "Pseudo trop long";
            // die();
        }

        $email = clean_input($_POST['email']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email invalide";
            // die();
        }
        $password = $_POST['password'];
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/', $password)) {
            $message = "👉Elle au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial";
        }

        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        // if (!$role) {
        //     $error = "Veuillez choisir un rôle";
        //     // die();
        // }

        if ($role === 'admin') {
            if (empty($_POST['access_code']) || $_POST['access_code'] !== '1999@') {
                $error = "Code d'accès invalide. Veuillez cocher le rôle utilisateur ou entrer le bon code d'accès.";
            }
        }

        //interrogeona la base de donnee pors savoir si le mail est deja prit ou pas
        $sql = "SELECT * FROM `utilisateurs` WHERE `email`=:email";
        $requete = $db->prepare($sql);
        $requete->bindValue(':email', $email, PDO::PARAM_STR);
        $requete->execute();
        $userExist = $requete->fetch();
        if ($userExist) {
            $error = "Email déjà utilisé";
            // return; // Arrête l'exécut
        }
        if (empty($error)) {
            $sql = "INSERT INTO `utilisateurs` (`pseudo`, `email`, `password`, `roles`) 
                    VALUES (:pseudo, :email, :password_hash, :role)";
            $requete = $db->prepare($sql);
            $requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $requete->bindValue(':email', $email, PDO::PARAM_STR);
            $requete->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            $requete->bindValue(':role', $role, PDO::PARAM_STR);
            $requete->execute();
            $error = "✅ Inscription réussie ! Connectez-vous.";
        } else {
            $error = "❌ Veuillez respecter les critères.";
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}


?>


<?php

require_once "header-and-footer/header.php";
?>
<h2 class="text-4xl font-bold text-green-900 text-center mb-6">Veuillez vous inscrire</h2>

<form method="POST" action="" class=" bg-white p-6 rounded shadow max-w-lg mx-auto">
    <div class="flex flex-col gap-[7px] pt-[7px]">
        <?php
        if (isset($error)) {
            echo '<p class="bg-green-500  border-green-300 p-[9px] rounded focus:outline-none focus:border-green-500 text-white font-bold min-h-[30px]">' . $error . '</p>';
        }

        ?>
        <div class="text-left flex flex-col gap-[7px]">
            <label for="pseudo" class="">Pseudo :</label>

            <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php echo $pseudo ?? ""  ?>" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>
        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail">Email :</label>

            <input type="emal" required placeholder="Votre mail" id="mail" value="<?php echo $email ?? ""  ?>" name="email" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>


        <div class="text-left flex flex-col gap-[7px]">
            <label for="password">Mot de passe</label>
            <div class="relative">
                <input type="password" required placeholder="Votre mot de passe" id="password" name="password"
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value="<?php echo $password ?? ""  ?>" />

                <i class="fa-solid fa-eye  absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i>
            </div>
        </div>
        <!-- <div class="text flex  gap-[34px] justify-center">
          
            <label for="administrateur">administrateur</label>
            <input type="radio" name="role" id="administrateur" value="admin">
            <label for="users">users</label>
            <input type="radio" name="role" id="users" value="user">
        </div> -->

        <div class="text flex gap-[34px] justify-center">
            <label for="administrateur">Administrateur</label>
            <input type="radio" name="role" id="administrateur" value="admin" onclick="toggleAccessCode(true)">
            <label for="users">Utilisateur</label>
            <input type="radio" name="role" id="users" value="user" onclick="toggleAccessCode(false)">
        </div>

        <div id="access-code-container" class="text-left flex flex-col gap-[7px]" style="display: none;">
            <label for="access-code">Code d'accès :</label>
            <input type="text" id="access-code" name="access_code" placeholder="Entrez le code d'accès"
                class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>

        <script>
            function toggleAccessCode(show) {
                const accessCodeContainer = document.getElementById('access-code-container');
                accessCodeContainer.style.display = show ? 'block' : 'none';
            }
        </script>
        <div class="text-left flex flex-col gap-[7px]">
            <input type="submit" name="forminscription" value="S'inscrire" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
        </div>

        <div class="w-full text-left flex  gap-[7px] justify-between">


            <a
                href="connexion.php" class="border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100">Se connecter
            </a>
        </div>
    </div>
</form>



<script src="javascript/script-index.js"></script>



<?php
require_once "header-and-footer/footer.php";
?>