<?php
require_once "database.php";
require "clean_input.php";

$error = ""; // Initialisation de la variable d'erreur

if (!empty($_POST)) {
    if (
        isset($_POST['pseudo'], $_POST['email'], $_POST['password']) &&
        !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])
    ) {
        $pseudo = clean_input($_POST['pseudo']);
        $email = clean_input($_POST['email']);
        $password = $_POST['password'];

        // Validation du pseudo
        if (strlen($pseudo) > 40) {
            $error = "❌ Pseudo trop long.";
        }

        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "❌ Email invalide.";
        }

        // Validation du mot de passe
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/', $password)) {
            $error = "❌ Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
        }

        // Hachage du mot de passe
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Vérification si l'email existe déjà
        if (empty($error)) {
            $sql = "SELECT * FROM `utilisateurs` WHERE `email` = :email";
            $requete = $db->prepare($sql);
            $requete->bindValue(':email', $email, PDO::PARAM_STR);
            $requete->execute();
            $userExist = $requete->fetch();

            if ($userExist) {
                $error = "❌ Email déjà utilisé.";
            }
        }

        // Insertion dans la base de données si aucune erreur
        if (empty($error)) {
            $sql = "INSERT INTO `utilisateurs` (`pseudo`, `email`, `password`) 
                    VALUES (:pseudo, :email, :password_hash)";
            $requete = $db->prepare($sql);
            $requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $requete->bindValue(':email', $email, PDO::PARAM_STR);
            $requete->bindValue(':password_hash', $password_hash, PDO::PARAM_STR);
            $requete->execute();

            $error = "✅ Inscription réussie ! Connectez-vous.";
        }
    } else {
        $error = "❌ Veuillez remplir tous les champs.";
    }
}
?>

<?php
$title="inscription";
require_once "header-and-footer/header.php";
?>
<?php    require_once "navbar.php"?>
<h2 class="text-4xl font-bold text-green-900 text-center mb-6">Veuillez vous inscrire</h2>

<form method="POST" action="" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <div class="flex flex-col gap-[7px] pt-[7px]">
        <?php if (!empty($error)) : ?>
            <p class="bg-green-500 border-green-300 p-[9px] rounded focus:outline-none focus:border-green-500 text-white font-bold min-h-[30px]">
                <?= $error ?>
            </p>
        <?php endif; ?>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="pseudo">Pseudo :</label>
            <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?= $pseudo ?? "" ?>" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail">Email :</label>
            <input type="email" required placeholder="Votre mail" id="mail" value="<?= $email ?? "" ?>" name="email" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="password">Mot de passe</label>
            <div class="relative">
                <input type="password" required  placeholder="Votre mot de passe"  id="password" name="password" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value="<?php echo $password ??"" ?>"  />
                <i class="fa-solid fa-eye absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i>
            </div>
        </div>

        <div class="text-left flex flex-col gap-[7px]">
            <input type="submit" name="forminscription" value="S'inscrire" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
        </div>

        <div class="w-full text-left flex gap-[7px] justify-between">
            <a href="connexion.php" class="border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100">Se connecter</a>
        </div>
    </div>
</form>

<script src="javascript/script-index.js"></script>

<?php
require_once "header-and-footer/footer.php";
?>