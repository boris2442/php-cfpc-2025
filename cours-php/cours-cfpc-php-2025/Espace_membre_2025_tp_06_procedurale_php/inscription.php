<?php

require_once "header-and-footer/header.php";
?>




<h2 class="text-4xl font-bold text-green-900 text-center mb-6">Veuillez vous inscrire</h2>

<form method="POST" action="" enctype="multipart/form-data" class="bg-white p-6 rounded shadow max-w-lg mx-auto">
    <div class="flex flex-col gap-[7px] pt-[7px]">
        <?php
        if (isset($error)) {
            echo '<p class="bg-green-500  border-green-300 p-2 rounded focus:outline-none focus:border-green-500 text-white font-bold">' . $error . '</p>';
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







<?php
require_once "header-and-footer/footer.php";
?>