<?php
if(isset($_POST['create'])){
    echo "formulaire ok";
    $nom_student=$_POST['nom'];
    echo "nom: $nom_student";
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
    <h1 class="text-3xl font-bold underline">
        Hell
    </h1>


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

</body>

</html>