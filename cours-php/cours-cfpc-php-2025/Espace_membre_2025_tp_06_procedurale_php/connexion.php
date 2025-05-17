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
        // $sql = "SELECT* FROM `utilisateurs` WHERE email=:email";
        $sql = "SELECT id, pseudo, email, roles, avatar, password FROM `utilisateurs` WHERE email = :email";

        $requete = $db->prepare($sql);
        $requete->bindValue(":email", $email);
        $requete->execute();
        $users = $requete->fetch();
        echo "<pre>";
        var_dump($users);
        echo "</pre>";
        if (!$users) {
            $error = "❌ Aucun utilisateur trouvé avec cet email.";
        }


        //verification du mot de passe
        $password = $_POST['password'];


        if ($users && !password_verify($password, $users['password'])) {
            $error = " ❌ incorrect password";
        }


        if (empty($error)) {

            $_SESSION['users'] = [
                'id' => $users['id'],
                'email' => $users['email'], // c’est bien "mail" dans ta BDD
                'roles' => $users['roles'],
                'pseudo' => $users['pseudo']
            ];

            // var_dump($_SESSION['users']);
            // echo "<pre>";
            // print_r($_SESSION['users']);
            // echo "</pre>";


            // $_SESSION['id'] = $users['id'];
            // $_SESSION['pseudo'] = $users['pseudo'];
            // $_SESSION['email'] = $users['mail'];
            // $_SESSION['roles'] = $users['roles'];
            // Si l'utilisateur a coché "Se souvenir de moi"
            if (isset($_POST['remember_me'])) {
                setcookie(
                    'email',  //nom du cookie
                    $users['email'],  //valeur a stocker
                    time() + 365 * 24 * 3600,  //3. date d’expiration (timestamp) : ici « now + 1 an »
                    "/",  //le chemin accessible sur le domaine ("/" pour tout le site)
                    null,  // le domaine (null = domaine courant)
                    false,  //secure (false = cookie envoyé en HTTP et HTTPS, true = uniquement HTTPS)
                    true  // httponly (true = inaccessible en JavaScript, renforce la sécurité)
                ); // Cookie valide pendant 1 an
            } else {
                // Si la case n'est pas cochée, supprimer le cookie existant
                setcookie(
                    'email', //nom du cookie
                 '', //On lui assigne une chaîne vide, c’est-à-dire qu’il ne contient plus rien.
                  time() - 3600, //time() renvoie l’heure actuelle en secondes depuis le 1er janvier 1970.
                   "/" //On indique que l’on supprime le cookie défini sur l’ensemble du site 
                );
            }

            // header("location:profil.php?id=" . $_SESSION['id']);
            header("location:profil.php?id=" . $_SESSION['users']['id']);

            exit();
        }
    } else {
        $error = "veuillez remplir tous les champs";
    }
}

?>

<?php
require_once "header-and-footer/header.php";
?>
<?php require_once "navbar.php" ?>
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


        <div class="w-full text-left flex  gap-[7px] ">



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