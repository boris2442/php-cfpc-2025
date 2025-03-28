<?php
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if (!empty($_POST)) {
    //     if (
    //         isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['adresse'], $_POST['telephone'], $_POST['datenaissance'], $_POST['interet'])
    //         && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['adresse']) && !empty($_POST['telephone']) && !empty($_POST['datenaissance']) && !empty($_POST['interet'])
    //     ) {
    //         $nom = clean_input($_POST['nom']);
    //         $prenom = clean_input($_POST['prenom']);
    //         $email = clean_input($_POST['email']);
    //         $adresse = clean_input($_POST['adresse']);
    //         $telephone = clean_input($_POST['telephone']);
    //         $datenaissance = clean_input($_POST['datenaissance']);
    //         $interet = clean_input($_POST['interet']);

    //         if (strlen($nom) > 50) {
    //             // $message="";
    //             return "le nom de doit pas exceder 30 caracteres.";
    //         }
    //         if (strlen($prenom) > 50) {
    //             return "le  prenom de doit pas exceder 50 caracteres.";
    //         }

    //     }
    // }
    function clean_input($data)
    {
        return (htmlspecialchars(stripslashes((trim($data)))));
    }

    $nom = clean_input($_POST['nom']);
    $prenom = clean_input($_POST['prenom']);
    $email = clean_input($_POST['email']);
    $adresse = clean_input($_POST['adresse']);
    $telephone = clean_input($_POST['telephone']);
    $datenaissance = clean_input($_POST['datenaissance']);
    $interet = clean_input($_POST['interet']);
    // $genre=$_POST['genre'];
    // $langue=$post['langues'];
    // $etudes=$_POST['etudes'];
    // $photo=$_POST['photo'];
    // $image=$_POST['image'];
    function create(
        $nom,
        $prenom,
        $email,
        $adresse,
        $telephone,
        $datenaissance,
        $interet
        // , $photo, $image, $langue, $etudes
    ) {
        global $db;
        if (
            empty($nom) || empty($prenom) || empty($email) || empty($adresse) || empty($telephone) || empty($datenaissance) || empty($interet)
        ) {
            return "tous les champs vont etre remplir...";
        }
        if (strlen($nom) > 50) {
            return "le nom est trop long!";
        }
        if (strlen($prenom) > 50) {
            return "Le prenom est trop long";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "L'email est incorrect";
        }

        if (strlen($adresse) > 255) {
            return "L'adresse est trop longue";
        }
        if (!preg_match('/^[0-9]+$/', $telephone)) {
            return "Le numéro de téléphone doit contenir uniquement des chiffres.";
        }
        if (strlen($telephone) > 20) {
            return "Le numéro de téléphone ne doit pas dépasser 20 chiffres.";
        }
        if (!isValidDate($datenaissance, 'd/m/Y')) {
            return "invalid date use this format  JJ/MM/AAAA.";
        }
        if (strlen($interet) > 255) {
            return "L'intérêt est trop long";
        }
    }

    function isValidDate($date, $format = 'd/m/Y')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }


    // function isValidDate($date, $format = 'd/m/Y')
    // {
    //     $d = DateTime::createFromFormat($format, $date);
    //     return $d && $d->format($format) === $date;
    // }

    // // Exemple d'utilisation
    // $datenaissance = $_POST['datenaissance'];

    // if (!isValidDate($datenaissance, 'd/m/Y')) {
    //     return "La date de naissance est invalide.";
    // }
}













?>













<?php
require_once "header-and-footer/header.php";
?>
<div class="container mx-auto p-4 text-center">
    <h1 class="text-3xl font-bold text-green-900 mb-4">Créer un nouveau
        Étudiant</h1>

    <form action="post" method="" class="bg-white
p-6 rounded shadow max-w-md mx-auto ">
        <!-- Nom -->
        <!-- <div class="mb-4 text-left">
            <label for="nom" class="block text-gray-700"></label>
            <input type="text" id="nom" 
                class="w-full border border-green-300 p-2 rounded focus:outline-none
focus:border-green-500">
        </div> -->
        <div class="mb-4 text-left">
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
            <label for="interets" class="block text-gray-700">Vos intérêts :</label>
            <textarea id="interets" name="interet" placeholder="Vos intérêts"
                rows="4"
                class="w-full border border-green-300 p-2 rounded focus:outline-none
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
            <input type="file" id="document" name="document"
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