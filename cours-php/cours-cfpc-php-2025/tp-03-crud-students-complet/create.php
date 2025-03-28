<?php
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
    $document = $_FILES['document'];
    $image = $_FILES['image'];
    $interet = clean_input($_POST['interet']);
    $genre = isset($_POST['genre']) ? clean_input($_POST['genre']) : "";
    $langues = isset($_POST['langues']) ? $_POST['langues'] : [];
    $langues_str = implode(", ",  $langues);
    $etudes = isset($_POST['etudes']) ? $_POST['etudes'] : [];
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
        $interet,
        $image,
        $document
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
        // Appel de la fonction handleImageUpload pour valider et traiter l'image
        $imageResult = handleImageUpload($image);

        // Vérifiez si handleImageUpload a retourné une erreur
        if (is_string($imageResult)) {
            return $imageResult; // Retourne le message d'erreur
        }
        // Appel de la fonction handleDocumentUpload pour valider et traiter le document
        $documentResult = handleDocumentUpload($document);

        // Vérifiez si handleDocumentUpload a retourné une erreur
        if (is_string($documentResult)) {
            return $documentResult; // Retourne le message d'erreur
        }
    }











    function isValidDate($date, $format = 'd/m/Y')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
    function handleImageUpload($file, $allowed_extensions = ['jpg', 'jpeg', 'png'], $max_size_mb = 5)
    {
        // Vérifiez si un fichier a été téléchargé sans erreur
        if ($file['error'] !== 0) {
            return "❌ Une erreur est survenue lors du téléchargement de l'image.";
        }

        // Récupération des informations sur le fichier
        $image_name = $file['name'];
        $image_tmp = $file['tmp_name'];
        $image_size = $file['size'];
        $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // Vérification de l'extension
        if (!in_array($image_extension, $allowed_extensions)) {
            return "❌ Format d'image invalide. Formats autorisés : " . implode(', ', $allowed_extensions) . ".";
        }

        // Vérification de la taille (convertir Mo en octets)
        $max_size_bytes = $max_size_mb * 1024 * 1024;
        if ($image_size > $max_size_bytes) {
            return "❌ L'image ne doit pas dépasser {$max_size_mb} Mo.";
        }

        // Lecture du fichier en binaire
        $image_data = file_get_contents($image_tmp);

        // Retourner les données de l'image en cas de succès
        return [
            'name' => $image_name,
            'extension' => $image_extension,
            'size' => $image_size,
            'data' => $image_data // Contenu binaire de l'image
        ];
    }

    function handleDocumentUpload($file, $allowed_extensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt'], $max_size_mb = 5)
    {
        // Vérifiez si un fichier a été téléchargé sans erreur
        if ($file['error'] !== 0) {
            return "❌ Une erreur est survenue lors du téléchargement du document.";
        }

        // Récupération des informations sur le fichier
        $document_name = $file['name'];
        $document_tmp = $file['tmp_name'];
        $document_size = $file['size'];
        $document_extension = strtolower(pathinfo($document_name, PATHINFO_EXTENSION));

        // Vérification de l'extension
        if (!in_array($document_extension, $allowed_extensions)) {
            return "❌ Format de document invalide. Formats autorisés : " . implode(', ', $allowed_extensions) . ".";
        }

        // Vérification de la taille (convertir Mo en octets)
        $max_size_bytes = $max_size_mb * 1024 * 1024;
        if ($document_size > $max_size_bytes) {
            return "❌ Le document ne doit pas dépasser {$max_size_mb} Mo.";
        }

        // Lecture du fichier en binaire
        $document_data = file_get_contents($document_tmp);

        // Retourner les données du document en cas de succès
        return [
            'name' => $document_name,
            'extension' => $document_extension,
            'size' => $document_size,
            'data' => $document_data // Contenu binaire du document
        ];
    }
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
            <input type="file" id="photo" name="image"
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