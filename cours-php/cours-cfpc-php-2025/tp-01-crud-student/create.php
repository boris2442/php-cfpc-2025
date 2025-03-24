<?php
require_once "database.php";
$message = "";
if (isset($_POST['create'])) {
    $nom = htmlspecialchars($_POST['nom']);

    $prenom = htmlspecialchars($_POST['prenom']);

    $mail = htmlspecialchars($_POST['mail']);
    if (empty($_POST['nom']) || empty($prenom) || empty($mail)) {
        // $message = "Veuillez remplir tous les champs";
        $message = ' <span style="background:red; padding:10px; color:white margin:15px;"> Veillez remplir les champs </span>';
    } else {
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/output.css">
    <title>Créer un nouveau Etudiant</title>

</head>

<body class="bg-green-100">
    <div class="container mx-auto p-4  text-center">
        <h1 class="text-3xl font-bold text-green-900 text-center mb-4">Créer un nouveau Etudiant</h1>


        <!-- <div class="mb-4">
            <div class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500"><?php echo $message; ?></div>

        </div> -->
        <!-- <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded "> -->
        <?= $message ?>
        <!--           </div> -->
        <form action="" method="post" class="bg-white p-6 rounded shadow max-w-md mx-auto">

            <div class="mb-4">
                <input type="text" name="nom" placeholder="Nom"
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
            </div>
            <div class="mb-4">
                <input type="text" name="prenom" placeholder="Prénom"
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
            </div>
            <div class="mb-4">
                <input type="email" name="mail" placeholder="Email"
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
            </div>
            <div class="text-center">
                <input type="submit" name="create" value="Créer"
                    class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            </div>
        </form>

        <div class="mt-4 text-center">
            <a class=" my-5 px-4 py-2 mr-5 bg-green-600 text-white rounded hover:bg-green-700" href="http://localhost/php-2025/cours-php/cours-cfpc-php-2025/tp-01-crud-student/">Liste
                des étudiants
            </a>
        </div>
    </div>


</body>


</html>