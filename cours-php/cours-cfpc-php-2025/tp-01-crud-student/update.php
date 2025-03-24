<?php
require_once "database.php";
$message = "";


function clean_input($data)
{
    // $data = trim($data);
    // $data2 = stripslashes($data);
    // $data_result = htmlspecialchars($data2);
    // return $data_result;
    return (htmlspecialchars(stripslashes(trim($data))));
}
// $nom=clean_input($_POST['nom']);
// $prenom=clean_input($_POST['prenom']);
// $mail=clean_input($_POST['mail']);
if (isset($_GET['id'])) {
    $id = clean_input($_GET['id']);
    $sql = "SELECT * FROM `students2` WHERE `id`=:id";
    $requete = $db->prepare($sql);
    $requete->execute(['id' => $id]);
    $result = $requete->fetch();
    // if (!$result) {
    //     $message = '<span style="background:red; padding:10px; color:white margin:15px;"> Etudiant non trouvé</span>';
    // }


    if ($result) {
        $nom = $result['nom'];
        $prenom = $result['prenom'];
        $mail = $result['mail'];
    } else {
        $message = '<span style="background:red; padding:10px; color:white margin:15px;"> Étudiant non trouvé</span>';
        $nom = $prenom = $mail = ""; // Initialisation des champs à vide
    }
} else {
    $nom = $prenom = $mail = ""; // Initialisation des champs à vide si aucun ID n'est fourni
}





// }
if (isset($_POST['update'])) {
    $nom = clean_input($_POST['nom']);
    $prenom = clean_input($_POST['prenom']);
    $mail = clean_input($_POST['mail']);
    $sql = "UPDATE `students2` SET `nom`=:nom, `prenom`=:prenom, `mail`=:mail WHERE `id`=:id";
    $requete = $db->prepare($sql);
    $requete->execute(['nom' => $nom, 'prenom' => $prenom, 'mail' => $mail, 'id' => $id]);
    $message = '<span style="background:green; padding:10px; color:white margin:15px;"> Etudiant modifié avec succès</span>';
    header("location:index.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/output.css">
    <title>Modifier l'etudiant</title>

</head>

<body class="bg-green-100">
    <div class="container mx-auto p-4  text-center">
        <h1 class="text-3xl font-bold text-green-900 text-center mb-4">Modifier l'etudiant</h1>


        <!-- <div class="mb-4">
            <div class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500"><?php echo $message; ?></div>

        </div> -->
        <!-- <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded "> -->
        <?= $message ?>
        <!--           </div> -->
        <form action="" method="post" class="bg-white p-6 rounded shadow max-w-md mx-auto">

            <div class="mb-4">
                <input type="text" name="nom" placeholder="Nom"
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value="<?php echo $nom ?? ""; ?>">
            </div>
            <div class="mb-4">
                <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom ?? ""; ?>"
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
            </div>
            <div class="mb-4">
                <input type="email" name="mail" placeholder="Email" required value="<?php echo $mail ?? ""; ?>"
                    class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
            </div>
            <div class="text-center">
                <input type="submit" name="update" value="Modifier"
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