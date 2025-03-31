<?php
require_once "database.php";

$message = ""; // Variable pour stocker les messages d'erreur ou de succès



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function clean_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Récupération des champs
    $nom = clean_input($_POST['nom'] ?? '');
    $prenom = clean_input($_POST['prenom'] ?? '');
    $email = clean_input($_POST['email'] ?? '');
    $adresse = clean_input($_POST['adresse'] ?? '');
    $telephone = clean_input($_POST['telephone'] ?? '');
    $datenaissance = clean_input($_POST['datenaissance'] ?? '');
    $genre = $_POST['genre'] ?? null;
    $langues = $_POST['langues'] ?? [];
    $etudes = $_POST['etudes'] ?? null;
    $interets = clean_input($_POST['interets'] ?? '');

    // Validation des champs obligatoires
    if (empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($datenaissance) || empty($genre) || empty($langues) || empty($etudes) || empty($interets)) {
        $message = "❌ Tous les champs obligatoires doivent être remplis.";
    } elseif (strlen($nom) > 50) {
        $message = "❌ Le nom est trop long !";
    } elseif (strlen($prenom) > 50) {
        $message = "❌ Le prénom est trop long !";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "❌ Email non valide.";
    } elseif (strlen($telephone) > 30) {
        $message = "❌ Le numéro de téléphone ne doit pas dépasser 30 caractères.";
    } elseif (strlen($interets) > 255) {
        $message = "❌ Les intérêts sont trop longs !";
    } else {
        // Vérification si l'email existe déjà
        $sql = "SELECT COUNT(*) FROM `users` WHERE email = :email";
        $requete = $db->prepare($sql);
        $requete->bindValue(':email', $email);
        $requete->execute();
        $emailExists = $requete->fetchColumn();

        if ($emailExists > 0) {
            $message = "❌ Cet email est déjà utilisé. Veuillez en choisir un autre.";
        } else {
            // Traitement des fichiers
            $image = null;
            $doc_content = null;

            // Gestion de la photo
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
                $image_tmp = $_FILES['photo']['tmp_name'];
                $image_extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                $allowed_extensions = ['jpg', 'jpeg', 'png'];

                if (!in_array($image_extension, $allowed_extensions)) {
                    $message = "❌ Format d'image invalide. Formats autorisés : JPG, JPEG, PNG.";
                } elseif ($_FILES['photo']['size'] > 3 * 1024 * 1024) {
                    $message = "❌ L'image ne doit pas dépasser 3 Mo.";
                } else {
                    $image = file_get_contents($image_tmp);
                }
            }

            // Gestion du document
            if (isset($_FILES['document']) && $_FILES['document']['error'] === 0) {
                $doc_tmp = $_FILES['document']['tmp_name'];
                $doc_extension = strtolower(pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION));
                $allowed_extensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];

                if (!in_array($doc_extension, $allowed_extensions)) {
                    $message = "❌ Format de document invalide.";
                } elseif ($_FILES['document']['size'] > 3 * 1024 * 1024) {
                    $message = "❌ Le fichier dépasse 3 Mo.";
                } else {
                    $doc_content = file_get_contents($doc_tmp);
                }
            }

            // Si aucune erreur, insertion dans la base de données
            if (empty($message)) {
                $langues_str = implode(',', $langues);

                $sql = "INSERT INTO `users` (`nom`, `prenom`, `email`, `adresse`, `telephone`, `datenaissance`, `genre`, `langues`, `etudes`, `interets`, `photo`, `document`) 
                        VALUES (:nom, :prenom, :email, :adresse, :telephone, :datenaissance, :genre, :langues, :etudes, :interets, :photo, :document)";
                $requete = $db->prepare($sql);

                try {
                    $requete->execute([
                        ':nom' => $nom,
                        ':prenom' => $prenom,
                        ':email' => $email,
                        ':adresse' => $adresse,
                        ':telephone' => $telephone,
                        ':datenaissance' => $datenaissance,
                        ':genre' => $genre,
                        ':langues' => $langues_str,
                        ':etudes' => $etudes,
                        ':interets' => $interets,
                        ':photo' => $image,
                        ':document' => $doc_content
                    ]);
                    $message = "✅ Succès ! Les données ont été enregistrées.";
                } catch (Exception $e) {
                    $message = "❌ Erreur SQL : " . $e->getMessage();
                }
            }
        }
    }
}









?>

<?php
$title="create";
require_once "header-and-footer/header.php";
?>
<div class="container mx-auto p-4 text-center">
    <h1 class="text-3xl font-bold text-green-900 mb-4">Créer un nouvel étudiant</h1>

    <form method="post" class="bg-white p-6 rounded shadow max-w-md mx-auto" enctype="multipart/form-data">
        <!-- Message -->
        <?php if (!empty($message)) : ?>
            <p class="border-1 p-[8px] border-solid border-red-500 rounded-[4px]"><?= $message ?></p>
        <?php endif; ?>

        <!-- Nom -->
        <div class="mb-4 text-left">
            <label for="nom" class="block text-gray-700">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Nom" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value="<?php  echo $nom ?? ''   ?>">
        </div>

        <!-- Prénom -->
        <div class="mb-4 text-left">
            <label for="prenom" class="block text-gray-700">Prénom :</label>
            <input type="text" id="prenom" name="prenom" placeholder="Prénom" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500"  value="<?php  echo $prenom ?? ''   ?>">
        </div>

        <!-- Email -->
        <div class="mb-4 text-left">
            <label for="mail" class="block text-gray-700">Email :</label>
            <input type="email" value="<?php  echo $email ?? ''   ?>"  id="mail" name="email" placeholder="Email" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500"  >
        </div>

        <!-- Adresse -->
        <div class="mb-4 text-left">
            <label for="adresse" class="block text-gray-700">Adresse :</label>
            <input type="text" id="adresse" name="adresse" placeholder="Adresse" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500"  value="<?php  echo $adresse ?? ''   ?>" >
        </div>

        <!-- Téléphone -->
        <div class="mb-4 text-left">
            <label for="telephone" class="block text-gray-700">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" placeholder="Téléphone" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value="<?php  echo $telephone ?? ''   ?>">
        </div>

        <!-- Date de naissance -->
        <div class="mb-4 text-left">
            <label for="date_naissance" class="block text-gray-700">Date de naissance :</label>
            <input type="date" id="date_naissance" name="datenaissance" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500" value="<?php  echo $datenaissance ?? ''   ?>">
        </div>

        <!-- Genre -->
        <div class="mb-4 text-left">
            <label class="block text-gray-700">Genre :</label>
            <label class="inline-flex items-center">
                <input type="radio" name="genre" value="masculin" class="mr-2"> Masculin
            </label>
            <label class="inline-flex items-center ml-4">
                <input type="radio" name="genre" value="feminin" class="mr-2"> Féminin
            </label>
        </div>

        <!-- Langues parlées -->
        <div class="mb-4 text-left">
            <label class="block text-gray-700">Langues parlées :</label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="langues[]" value="francais" class="mr-2"> Français
            </label>
            <label class="inline-flex items-center ml-4">
                <input type="checkbox" name="langues[]" value="anglais" class="mr-2"> Anglais
            </label>
            <label class="inline-flex items-center ml-4">
                <input type="checkbox" name="langues[]" value="espagnol" class="mr-2"> Espagnol
            </label>
        </div>

        <!-- Niveau d'étude -->
        <div class="mb-4 text-left">
            <label for="niveau_etude" class="block text-gray-700">Niveau d'étude :</label>
            <select id="niveau_etude" name="etudes" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
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
            <textarea id="interets" name="interets" placeholder="Vos intérêts" rows="4" class="resize-none w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500"  value="<?php $interets ?? '' ?>"></textarea>
        </div>

        <!-- Upload Photo -->
        <div class="mb-4 text-left">
            <label for="photo" class="block text-gray-700">Photo :</label>
            <input type="file" id="photo" name="photo" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>

        <!-- Upload Document -->
        <div class="mb-4">
            <label for="document" class="block text-gray-700">Document :</label>
            <input type="file" accept=".doc,.docx,.xls,.xlsx,.pdf" id="document" name="document" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center">
            <input type="submit" name="creer" value="Créer" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 cursor-pointer w-[100%]">
        </div>
    </form>
</div>

<?php
require_once "header-and-footer/footer.php";
?>