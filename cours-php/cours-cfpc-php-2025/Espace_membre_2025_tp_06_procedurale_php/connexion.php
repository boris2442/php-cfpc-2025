<?php
session_start();
require_once "database.php";
$error = "";
require "clean_input.php";
if (!empty($_POST)) {
    if (
        isset($_POST['email'], $_POST['password'])  && !empty($_POST['email']) && !empty($_POST['password'])


    ) {
        $email = clean_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "email is not valid";
        }
        $sql = "SELECT* FROM `utilisateurs` WHERE email=:email";
        $requete = $db->prepare($sql);
        $requete->bindValue(":email", $email);
        $requete->execute();
        $users = $requete->fetch();
        if (!$users) {
            $error = "❌ Aucun utilisateur trouvé avec cet email.";
        }


        //verification du mot de passe
        $password = $_POST['password'];
        // $sql = "SELECT* FROM `utilisateurs` WHERE` password=:password";
        // $requete = $db->prepare($sql);
        // $requete->bindValue(":password", $password);
        // $requete->execute();
        // $users = $requete->fetch();

        if (!password_verify($password, $users['password'])) {
            $error = " incorrect password";
        }

        // $role = $_POST['role'];
        // if ($role === 'admin') {
        //     if (empty($_POST['access_code']) || $_POST['access_code'] !== '1999@') {
        //         $error = "Code d'accès invalide. Veuillez cocher le rôle utilisateur ou entrer le bon code d'accès.";
        //     }
        // }
        // if(!$users['roles']===$role){
        //     $error="role incorrect";
        // }
        if (empty($error)) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $users['pseudo'];
            $_SESSION['email'] = $users['mail'];
            // Si l'utilisateur a coché "Se souvenir de moi"
            if (isset($_POST['remember_me'])) {
                setcookie('email', $users['email'], time() + 365 * 24 * 3600, "/", null, false, true); // Cookie valide pendant 1 an
            } else {
                // Si la case n'est pas cochée, supprimer le cookie existant
                setcookie('email', '', time() - 3600, "/");
            }
        }
        header("Location:profil.php?id=". $_SESSION['id']);
        exit();
    } else {
        $error = "veuillez remplir tous les champs";
    }
}

?>

<?php
require_once "header-and-footer/header.php";
?>
<h2 class="text-4xl font-bold text-green-900 text-center mb-6">Connectez vous!</h2>

<form method="POST" class=" bg-white p-6 rounded shadow max-w-lg mx-auto">
    <div class="flex flex-col gap-[7px] pt-[7px]">
        <?php
        if (isset($error)) {
            echo '<p class="bg-green-500  border-green-300 p-[9px] rounded focus:outline-none focus:border-green-500 text-white font-bold min-h-[30px]">' . $error . '</p>';
        }

        ?>

        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail">Email :</label>

            <input type="text" required placeholder="Votre mail" id="mail" value="<?php echo isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : ''; ?>" name="email" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>


        <div class="text-left flex flex-col gap-[7px]">
            <label for="password">Mot de passe</label>
            <div class="relative">
                <input type="password" placeholder="Votre mot de passe" id="password" name="password" required
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

        <!-- <div class="text flex gap-[34px] justify-center">
            <label for="administrateur">Administrateur</label>
            <input type="radio" name="role" id="administrateur" value="admin" onclick="toggleAccessCode(true)">
            <label for="users">Utilisateur</label>
            <input type="radio" name="role" id="users" value="user" onclick="toggleAccessCode(false)">
        </div>

        <div id="access-code-container" class="text-left flex flex-col gap-[7px]" style="display: none;">
            <label for="access-code">Code d'accès :</label>
            <input type="text" id="access-code" name="access_code" placeholder="Entrez le code d'accès"
                class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div> -->


        <div class="w-full text-left flex  gap-[7px] ">


            <!-- <a
    href="connexion.php" class="border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100">Se connecter
</a> -->
            <label for="souvenir">remember_me!</label>
            <input type="checkbox" name="remember_me" id="souvenir" value="Se souvenir de moi!">
        </div>
        <div class="text-left flex flex-col gap-[7px]">
            <input type="submit" name="formconnexion" value="Se connecter" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
        </div>


    </div>
</form>


<script>
    function toggleAccessCode(show) {
        const accessCodeContainer = document.getElementById('access-code-container');
        accessCodeContainer.style.display = show ? 'block' : 'none';
    }
</script>
<script src="javascript/script-index.js"></script>
<?php
require_once "header-and-footer/footer.php";
?>