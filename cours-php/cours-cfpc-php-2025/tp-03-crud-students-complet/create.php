<?php
// require_once "database.php";



// if (
//     isset($_POST['nom'], $_POST['prenom'], $_POST['email'],  $_POST['adresse'], $_POST['telephone'], $_POST['datenaissance'], $_POST['genre'], $_POST['languages'], $_POST['etudes'], $_POST['interet'], $_FILES['image'], $_FILES['document']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['adresse']) && !empty($_POST['telephone']) && !empty($_POST['datenaissance']) && !empty($_POST['interet'])
// ) {
//     $message = "";
//     function clean_input($data)
//     {
//         return (htmlspecialchars(stripslashes((trim($data)))));
//     }
//     $nom = clean_input($_POST['nom']);
//     if (strlen($nom) > 50) {
//         $message = "le nom est trop long!";
//     }
//     $prenom = clean_input($_POST['prenom']);
//     if (strlen($prenom) > 50) {
//         $message = "le prenom est trop long!";
//     }
//     if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//         $message = "email non valide";
//     }
//     $email = $_POST['email'];

//     $adresse = clean_input($_POST['adresse']);
//     if (strlen($prenom) > 150) {
//         $message = "l'adresse est trop long!";
//     }
//     $telephone = clean_input($_POST['telephone']);

//     if (!preg_match('/^[0-9]+$/', $telephone)) {
//         $message = "Le numéro de téléphone doit contenir uniquement des chiffres.";
//     }
//     if (strlen($telephone) > 20) {
//         $message =  "Le numéro de téléphone ne doit pas  dépasser 20 chiffres.";
//     }
//     $datenaissance = clean_input($_POST['datenaissance']);

//     if (isset($_POST['genre'])) {
//         $genre = $_POST['genre'];
//     } else {
//         $message = "selectionnez votre genre";
//     }
//     if (isset($_POST['languages'])) {
//         $languages = $_POST['languages'];
//         $language_str = implode('/', $languages);
//     } else {
//         $message = "veuillez checker!";
//     }
//     if (isset($_POST['etudes'])) {
//         $etudes = $_POST['etudes'];
//     } else {
//         $message = "veuilez choisir votre niveau d'etude";
//     }
//     $interet = clean_input($_POST['interet']);
//     if (strlen($interet > 255)) {
//         $message = "l'interet est tres long";
//     }
//     if ($_FILES['image']['error'] == 0) {
//         $image_name = $_FILES['image']['name'];
//         $image_tmp = $_FILES['image']['tmp_name'];
//         $image_size = $_FILES['image']['size'];
//         $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

//         $allowed_extensions = ['jpg', 'jpeg', 'png'];

//         // Vérification de l'extension
//         if (!in_array($image_extension, $allowed_extensions)) {
//             die("❌ Format d'image invalide. Formats autorisés : JPG, JPEG, PNG.");
//         }

//         // Vérification de la taille (max 3 Mo)
//         if ($image_size > 3 * 1024 * 1024) {
//             $message = "❌ L'image ne doit pas dépasser 3 Mo.";
//         }

//         // Lecture du fichier en binaire
//         $image = file_get_contents($image_tmp);

//         // Affichage pour vérification (supprimer en production)
//         $message = "✅ Image valide et prête à être stockée.";
//     } else {
//         $message = "❌ Erreur lors de l'envoi de l'image.";
//     }
//     //code reservé a l'insertion du document


//     if ($_FILES['document']['error'] == 0) {
//         $doc_tmp = $_FILES['document']['tmp_name'];
//         $doc_size = $_FILES['document']['size'];
//         $doc_extension = strtolower(pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION));

//         $allowed_extensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];

//         // Vérification de l'extension
//         if (!in_array($doc_extension, $allowed_extensions)) {
//             $message = "❌ Format invalide (seuls PDF, DOC, DOCX, XLS, XLSX sont acceptés).";
//         }
//         // Vérification de la taille (max 3 Mo)
//         else if ($doc_size > 3 * 1024 * 1024) {
//             $message = "❌ Le fichier dépasse 3 Mo.";
//         } else {
//             // Lecture du fichier en binaire
//             $doc_content = file_get_contents($doc_tmp);
//         }
//     }
//     $sql = "INSERT INTO `users` (`noms`, `prenom`, `email`, `adressse`, `telephone`,`datenaissance`, `genre`, `langues`, `etudes`, `interet`, `photo`,`document`) VALUES(:nom, :prenom, :email, :adresse, :telephone, :datenaissance, :genre, :langues,:etudes, :interet, :photo, :document)";
//     $requete = $db->prepare($sql);

//     $requete->bindValue(':nom', $nom);
//     $requete->bindValue(':prenom', $prenom);
//     $requete->bindValue(':email', $email);
//     $requete->bindValue(':adresse', $adresse);
//     $requete->bindValue(':telephone', $telephone);
//     $requete->bindValue(':datenaissance', $datenaissance);
//     $requete->bindValue(':genre', $genre);
//     $requete->bindValue(':langues', $langues);
//     $requete->bindValue(':etudes', $etudes);
//     $requete->bindValue(':interet', $interet);
//     $requete->bindValue(':photo', $image);
//     $requete->bindValue(':document', $doc_content);
//     $requete->execute();
//     $message = "Success congratulations";
// } else {
//     $message = "Tous les champs vont etre remplir";
// }



require_once "database.php";

if (
    isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['adresse'], $_POST['telephone'], $_POST['datenaissance'], $_POST['genre'], $_POST['langues'], $_POST['etudes'], $_POST['interet'], $_FILES['photo'], $_FILES['document'])
    && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['adresse']) && !empty($_POST['telephone']) && !empty($_POST['datenaissance']) && !empty($_POST['interet'])
) {
    function clean_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $nom = clean_input($_POST['nom']);
    if (strlen($nom) > 50) {
        $message = "Le nom est trop long !";
        return;
    }

    $prenom = clean_input($_POST['prenom']);
    if (strlen($prenom) > 50) {
        $message = "Le prénom est trop long !";
        return;
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $message = "Email non valide.";
        return;
    }
    $email = $_POST['email'];

    $adresse = clean_input($_POST['adresse']);
    if (strlen($adresse) > 150) {
        $message = "L'adresse est trop longue !";
        return;
    }

    $telephone = clean_input($_POST['telephone']);
    if (!preg_match('/^[0-9]+$/', $telephone)) {
        $message = "Le numéro de téléphone doit contenir uniquement des chiffres.";
        return;
    }
    if (strlen($telephone) > 30) {
        $message = "Le numéro de téléphone ne doit pas dépasser 30 chiffres.";
        return;
    }

    $datenaissance = clean_input($_POST['datenaissance']);
    $genre = $_POST['genre']?? null ;
    
    if (!$genre) {
        $message = "Sélectionnez votre genre.";
        return;
    }
    
    $langues = $_POST['langues']?? [] ;
    if (isset($langues)) {
        $message = "Veuillez cocher une langue.";
        return;
    }
    $langues_str = implode('/', $langues);
    
    $etudes = $_POST['etudes'] ;
    if (!$etudes) {
        $message = "Veuillez choisir votre niveau d'étude.";
        return;
    }

    $interet = clean_input($_POST['interet']);
    if (strlen($interet) > 255) {
        $message = "L'intérêt est trop long !";
        return;
    }
var_dump($interet);
    $image = null;
    $doc_content = null;

    if ($_FILES['photo']['error'] == 0) {
        $image_tmp = $_FILES['photo']['tmp_name'];
        $image_extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png'];

        if (!in_array($image_extension, $allowed_extensions)) {
            $message = "❌ Format d'image invalide. Formats autorisés : JPG, JPEG, PNG.";
            return;
        }

        if ($_FILES['photo']['size'] > 3 * 1024 * 1024) {
            $message = "❌ L'image ne doit pas dépasser 3 Mo.";
            return;
        }

        $image = file_get_contents($image_tmp);
    }

    if ($_FILES['document']['error'] == 0) {
        $doc_tmp = $_FILES['document']['tmp_name'];
        $doc_extension = strtolower(pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION));
        $allowed_extensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];

        if (!in_array($doc_extension, $allowed_extensions)) {
            $message = "❌ Format de document invalide.";
            return;
        }
        if ($_FILES['document']['size'] > 3 * 1024 * 1024) {
            $message = "❌ Le fichier dépasse 3 Mo.";
            return;
        }

        $doc_content = file_get_contents($doc_tmp);
    }

    $sql = "INSERT INTO `users` (`noms`, `prenom`, `email`, `adresse`, `telephone`, `datenaissance`, `genre`, `langues`, `etudes`, `interet`, `photo`, `document`) 
            VALUES(:nom, :prenom, :email, :adresse, :telephone, :datenaissance, :genre, :langues, :etudes, :interet, :photo, :document)";
    
    $requete = $db->prepare($sql);
    $requete->bindValue(':nom', $nom);
    $requete->bindValue(':prenom', $prenom);
    $requete->bindValue(':email', $email);
    $requete->bindValue(':adresse', $adresse);
    $requete->bindValue(':telephone', $telephone);
    $requete->bindValue(':datenaissance', $datenaissance);
    $requete->bindValue(':genre', $genre);
    $requete->bindValue(':langues', $langues_str);
    $requete->bindValue(':etudes', $etudes);
    $requete->bindValue(':interet', $interet);
    $requete->bindValue(':photo', $image);
    $requete->bindValue(':document', $doc_content);

    if ($requete->execute()) {
        $message = "✅ Succès ! Les données ont été enregistrées.";
    } else {
        $message = "❌ Erreur d'insertion dans la base de données.";
    }
} else {
    $message = "❌ Veuillez remplir tous les champs!";

}
?>























<?php
require_once "header-and-footer/header.php";
?>
<div class="container mx-auto p-4 text-center">
    <h1 class="text-3xl font-bold text-green-900 mb-4">Créer un nouveau
        Étudiant</h1>

    <form method="post" class="bg-white
p-6 rounded shadow max-w-md mx-auto " enctype="multipart/form-data">
        <!-- Nom -->
        <!-- <div class="mb-4 text-left">
            <label for="nom" class="block text-gray-700"></label>
            <input type="text" id="nom" 
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">
        </div> -->
        <div class="mb-4 text-left">
            <!--    <input type="text" class="bg-red-500" > -->
            <p class="border-1 p-[8px] border-solid border-red-500 rounded-[4px]"><?= $message ?> </p>
        </div>
        <div class="mb-4 text-left ">
            <label for="nom" class="block text-gray-700">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Nom" required
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">
        </div>
        <!-- Prénom -->
        <div class="mb-4  text-left">
            <label for="prenom" class="block text-gray-700">Prénom :</label>
            <input type="text" id="prenom" name="prenom" placeholder="Prénom"
                required
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">


        </div>
        <!-- Email -->
        <div class="mb-4 text-left">
            <label for="mail" class="block text-gray-700">Email :</label>
            <input type="email" id="mail" name="email" placeholder="Email" required
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">
        </div>
        <!-- Adresse -->
        <div class="mb-4 text-left">
            <label for="adresse" class="block text-gray-700">Adresse :</label>
            <input type="text" id="adresse" name="adresse" placeholder="Adresse"
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">
        </div>
        <!-- Téléphone -->
        <div class="mb-4 text-left">
            <label for="telephone" class="block text-gray-700">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" placeholder="Téléphone"
                required
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">
        </div>
        <!-- Date de naissance -->
        <div class="mb-4 text-left">

            <label for="date_naissance" class="block text-gray-700">Date de naissance
                :</label>
            <input type="date" id="date_naissance" name="datenaissance" required
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">
        </div>
        <!-- Genre -->
        <div class="mb-4 text-left">
            <label class="block text-gray-700">Genre :</label>
            <label class="inline-flex items-center">
                <input type="radio" name="genre" value="masculin" class="mr-2">
                Masculin
            </label>
            <label class="inline-flex items-center ml-4">
                <input type="radio" name="genre" value="feminin" class="mr-2"> Féminin
            </label>
        </div>
        <!-- Langues parlées -->
        <div class="mb-4 text-left">
            <label class="block text-gray-700">Langues parlées :</label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="langues[]" value="francais" class="mr-2">
                Français
            </label>
            <label class="inline-flex items-center ml-4">
                <input type="checkbox" name="langues[]" value="anglais" class="mr-2">
                Anglais
            </label>
            <label class="inline-flex items-center ml-4">
                <input type="checkbox" name="langues[]" value="espagnol" class="mr-2">
                Espagnol
            </label>
        </div>
        <!-- Niveau d'étude -->
        <div class="mb-4 text-left">
            <label for="niveau_etude" class="block text-gray-700">Niveau d'étude
                :</label>
            <select id="niveau_etude" name="etudes" required
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">
                <option value="">Sélectionnez votre niveau d'étude</option>
                <option value="lycee">Lycée</option>
                <option value="universite">Université</option>
                <option value="master">Master</option>
                <option value="doctorat">Doctorat</option>
            </select>
        </div>
        <!-- Intérêts -->
        <div class="mb-4 text-left">
            <label for="interets" class="block text-gray-700 ">Vos intérêts :</label>
            <textarea id="interets" name="interet" placeholder="Vos intérêts"
                rows="4"
                class="resize-none w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500"></textarea>
        </div>
        <!-- Upload Photo -->
        <div class="mb-4 text-left">
            <label for="photo" class="block text-gray-700">Photo :</label>
            <input type="file" id="photo" name="photo"
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">
        </div>
        <!-- Upload Document -->
        <div class="mb-4">
            <label for="document" class="block text-gray-700">Document :</label>
            <input type="file" accept=".doc,.docx,.xls,.xlsx,.pdf" id="document" name="document"
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">
        </div>
        <!-- Bouton de soumission -->
        <div class="text-center">
            <input type="submit" name="creer"
                class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bggreen-700 cursor-pointer w-[100%]">
        </div>
    </form>
    <div class="mt-4 text-center w-[100%]">
        <a class=" my-5 px-4 py-2 mr-5 bg-green-600 text-white rounded hover:bg-green-700 w-[100%]"
            href="">Liste
            des étudiants 2
        </a>
    </div>
</div>

<?php
require_once "header-and-footer/footer.php";
?>