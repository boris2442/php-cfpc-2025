<?php
session_start();

require_once "database.php";





function handle($db)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return "Error";
    }

    // // Vérifiez si le formulaire a été soumis
    $mailConnect = htmlspecialchars($_POST['mailconnect']);
    $mdpConnect = htmlspecialchars($_POST['mdpconnect']);
    if (empty($mailConnect) || empty($mdpConnect)) {
        return "Tous les champs doivent etre remplis";
    }
    return authentificateUser($db, $mailConnect, $mdpConnect);
    return  "Congratulation you are connecting!!!";
}

function authentificateUser($db, $mailConnect, $mdpConnect)
{
    $sql = "SELECT * FROM membres WHERE mail=:mailConnect ";
    $reqMail = $db->prepare($sql);
    $reqMail->execute(compact('mailConnect'));
    $mailExist = $reqMail->rowCount();
    // var_dump($mailExist);
    if (!$mailExist) {
        return "Ce mail n'existe pas";
    }
    //verification du password
    $userInfos =   $reqMail->fetch();
    echo "<pre>";
    var_dump($userInfos['mdp']);
    echo "</pre>";

    if (password_verify($mdpConnect, $userInfos['mdp'])) {
        return "ok";
    }



    $_SESSION['id'] = $userInfos['id'];
    $_SESSION['pseudo'] = $userInfos['pseudo'];
    $_SESSION['mail'] = $userInfos['mail'];

    header("Location: profil.php?id=". $_SESSION['id'] );
    exit();
    // return "Congratulation you are connecting!!!";
}
$error = handle($db);
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
                <input type="text" placeholder="enter your password" id="mdp" name="mdpconnect"
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500"
                    value=" " />




                <!-- <i class="fa fa-eye absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i> -->
                <!-- <i class="far fa-eye absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i> -->
                <i class="fa-solid fa-eye  absolute right-3 top-3 cursor-pointer text-gray-500" id="togglePassword"></i>
            </div>
        </div>



        <div class="text-left flex flex-col gap-[7px]">


            <input type="submit" value="Se connecter !" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100 " />
        </div>
    </div>
</form>


<script src="./javascript/script-index.js"></script>
<?php
require_once "header-and-footer/footer.php";
?>