<?php
require_once "database.php";
?>

<?php
require_once "header-and-footer/header.php";
?>

<!-- <div align="center"> -->
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

                <input type="text" placeholder="Votre mail" id="mail" value="<?php echo $mail ?? ""  ?>" name="mail" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
            </div>

            <div class="text-left flex flex-col gap-[7px]">
                <label for="mdp">Password :</label>

                <input type="password" placeholder="mot de passe" id="mdp" name="mdpconnect" name="mail" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" />
            </div>
            <div class="text-left flex flex-col gap-[7px]">


                <input type="submit" placeholder="mot de passe" value="Se connecter !" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500 bg-green-100" />
            </div>
        </div>
    </form>
 
<!-- </div> -->

<?php
require_once "header-and-footer/footer.php";
?>