<?php
if (isset($_POST['create'])) {
    echo "formulaire ok";
    // if (empty($_POST['nom'])) {
    //     echo "veuillez saisir le nom";
    // }
    // $nom_student = $_POST['nom'];
    // echo "nom: $nom_student</br>";
    // if (empty($_POST['prenom'])) {
    //     echo "veuillez remplir le prenom";
    // }
    // if (empty($_POST['mail'])) {
    //     echo "Veuillez remplir l'email";
    // }
    // $prenom_student = $_POST['prenom'];
    // echo "prenom: $prenom_student</br>";
    // $mail_student = $_POST['mail'];
    // echo "mail: $mail_student</br>";
    $message = "";
    if (empty($_POST['nom'])) {

        $message = "veuillez saisir le nom";
    } else if (empty($_POST['prenom'])) {
        $message = "veuillez saisir le nom";
    } else if (empty($_POST['mail'])) {
        $message = "veuillez saisir le nom";
    } else {
        $nom_student = $_POST['nom'];
        echo "nom: $nom_student</br>";
        $prenom_student = $_POST['prenom'];
        echo "prenom: $prenom_student</br>";
        $mail_student = $_POST['mail'];
        echo "mail: $mail_student</br>";
    }
    $mail = $_POST['mail'];
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        // $message = "L'adresse email est incorrecte";
        echo "L'adresse email est incorrecte";
    } else {
        echo "adresse mail:$mail";
    }
    if (!empty($_POST['password'])) {
        // echo "le mot de passe est obligatoire";

    }


    $password_hash = password_hash($_POST['password'], PASSWORD_ARGON2ID);
    echo "</br>mot de passe hashé: $password_hash";
}



?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
</head>

<body>



    <form action="" method="post" class="bg-white p-6 rounded shadow max-w-md mx-auto">

        <div class="bg-red-500 p-5 text-left mb-3"> <?php
                                                    //  echo $message; 
                                                    ?></div>


        <div class="mb-4">
            <input type="text" name="nom" placeholder="Nom"
                class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>
        <div class="mb-4">
            <input type="text" name="prenom" placeholder="Prénom"
                class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>
        <div class="mb-4">
            <input type="password" name="password" placeholder="mot de passe"
                class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>
        <div class="mb-4">
            <input type="text" name="mail" placeholder="Email"
                class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>
        <div class="text-center">
            <input type="submit" name="create" value="Créer"
                class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            <button href="http://localhost/php-2025/cours-php/cours-cfpc-php-2025/lecon-02/gestion-form.php"
                class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 cursor-pointer">refresh</button>
              
        </div>
    </form>

</body>

</html>