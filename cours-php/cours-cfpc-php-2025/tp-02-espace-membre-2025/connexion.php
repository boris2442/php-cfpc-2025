<?php
require_once "database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Italianno&family=Parkinsans:wght@300..800&family=Playwrite+HU:wght@100..400&family=Playwrite+PE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="./style/style.css">
    <title><?= isset($title) ? htmlspecialchars($title): "Espace membre"    ?></title>
</head>
<body>
<i class="fa-regular fa-envelope"></i>

<div align="center">
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
    <?php
    if (isset($erreur)) {
        echo '<font color="red">' . $erreur . "</font>";
    }
    ?>
</div>

</body>
</html>