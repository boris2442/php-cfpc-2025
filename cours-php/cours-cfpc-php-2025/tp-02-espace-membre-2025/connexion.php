<?php
require_once "database.php";

function handle($db)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    //recuperation des donnees du formulaires
    $mailConnect = htmlspecialchars($_POST['mailconnect']);
    $mdpConnect = htmlspecialchars($_POST['mdpconnect']);
    if (empty($mailConnect) || empty($mdpConnect)) {
        return "Tous les champs doivent etre remplis";
    }
    return authentificateUser($db, $mailConnect,     $mdpConnect);
}

function authentificateUser($db, $mailConnect,     $mdpConnect)
{
    $sql = "SELECT * FROM membres WHERE mail=:mailConnect ";
    $reqMail = $db->prepare($sql);
    $reqMail->execute(compact('mailConnect'));
    $mailExist = $reqMail->fetch();
    // var_dump($mailExist);
    if (!$mailExist) {
        return "Ce mail n'existe pas";
    }
    //verification du password
    if (password_verify($mdpConnect, $mailExist['mdp'])) {
    }
}
$error=handle($db);
?>

<?php
$title = "connecting";
require_once "header-and-footer/header.php";
?>


<h2 class=" text-4xl font-bold text-green-900 text-center mb-6">Connexion</h2>

<form method="POST" action="" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <div class="flex flex-col gap-[5px]">
        <?php
        if (isset($error)) {
            echo '<p class="bg-red-500 w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 text-white font-bold">' . $error . '</p>';
        }

        ?>
        <div class="text-left flex flex-col gap-[7px]">
            <label for="mail">Mail :</label>

            <input type="text" placeholder="Votre mail" id="mail" value="<?php echo $mailConnect ?? ""  ?>" name="mailconnect" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div>


        <!-- <div class="text-left flex flex-col gap-[7px]">
            <label for="mdp">Password :</label>

            <input type="password" placeholder="mot de passe" id="mdp" name="mdpconnect" value="<?php echo $mdpConnect ?>" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
        </div> -->

   <div class="text-left flex flex-col gap-[7px]">
            <label for="mdp">Password :</label>
            <div class="relative">
                <input  type="password" placeholder="enter your password"  id="mdp" name="mdpconnect" 
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500"  value="<?php echo $mdpconnect  ?? ''?>" />
                <!-- <i class="fa fa-eye absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i> -->
                <!-- <i class="far fa-eye absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i> -->
                <i class="fa-solid fa-eye  absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i>
            </div>
        </div>



        <div class="text-left flex flex-col gap-[7px]">


            <input type="submit" placeholder="mot de passe" value="Se connecter !" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
        </div>
    </div>
</form>


<script src="./javascript/script-index.js"></script>
<?php
require_once "header-and-footer/footer.php";
?>