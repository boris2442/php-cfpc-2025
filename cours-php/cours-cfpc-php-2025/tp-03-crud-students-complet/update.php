<?php
require "database.php";

function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$message = ""; // Variable pour afficher les messages d'erreur ou de succès

// Vérification si un ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM `users` WHERE `id` = :id";
    $requete = $db->prepare($sql);
    $requete->execute(['id' => $id]);
    $user = $requete->fetch();

    if ($user) {
        // Pré-remplir les champs avec les données existantes
        $nom = clean_input($user['nom']);
        $prenom = clean_input($user['prenom']);
        $email = clean_input($user['email']);
        $adresse = clean_input($user['adresse']);
        $telephone = clean_input($user['telephone']);
        $datenaissance = clean_input($user['datenaissance']);
        $genre = clean_input($user['genre']);
        $langues = explode(',', $user['langues']);
        $etudes = clean_input($user['etudes']);
        $interets = clean_input($user['interets']);
    } else {
        $message = "❌ Étudiant introuvable.";
    }
} else {
    $message = "❌ Aucun ID fourni.";
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editer'])) {
    $nom = clean_input($_POST['nom']);
    $prenom = clean_input($_POST['prenom']);
    $email = clean_input($_POST['email']);
    $adresse = clean_input($_POST['adresse']);
    $telephone = clean_input($_POST['telephone']);
    $datenaissance = clean_input($_POST['datenaissance']);
    $genre = $_POST['genre'] ?? null;
    $langues = implode(',', $_POST['langues'] ?? []);
    $etudes = $_POST['etudes'] ?? null;
    $interets = clean_input($_POST['interets']);

    // Validation des champs
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
        // Mise à jour des données dans la base de données
        $sql = "UPDATE `users` SET 
                    `nom` = :nom, 
                    `prenom` = :prenom, 
                    `email` = :email, 
                    `adresse` = :adresse, 
                    `telephone` = :telephone, 
                    `datenaissance` = :datenaissance, 
                    `genre` = :genre, 
                    `langues` = :langues, 
                    `etudes` = :etudes, 
                    `interets` = :interets 
                WHERE `id` = :id";
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
                ':langues' => $langues,
                ':etudes' => $etudes,
                ':interets' => $interets,
                ':id' => $id
            ]);
            $message = "✅ Étudiant modifié avec succès.";
            header("refresh: 2; url=index.php");
            exit;
        } catch (Exception $e) {
            $message = "❌ Erreur SQL : " . $e->getMessage();
        }
    }
}
?>

<?php
$title = "Modifier un étudiant";
require_once "header-and-footer/header.php";
?>

<div class="container mx-auto p-4 text-center">
    <h1 class="text-3xl font-bold text-green-900 mb-4">Modifier un étudiant</h1>

    <?php if (!empty($message)) : ?>
        <p class="border-1 p-[8px] border-solid border-red-500 rounded-[4px]"><?= $message ?></p>
    <?php endif; ?>

    <form method="post" class="bg-white p-6 rounded shadow max-w-md mx-auto" enctype="multipart/form-data">
        <!-- Nom -->
        <div class="mb-4 text-left">
            <label for="nom" class="block text-gray-700">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?= $nom ?? '' ?>" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>

        <!-- Prénom -->
        <div class="mb-4 text-left">
            <label for="prenom" class="block text-gray-700">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value="<?= $prenom ?? '' ?>" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>

        <!-- Email -->
        <div class="mb-4 text-left">
            <label for="email" class="block text-gray-700">Email :</label>
            <input type="email" id="email" name="email" value="<?= $email ?? '' ?>" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>

        <!-- Adresse -->
        <div class="mb-4 text-left">
            <label for="adresse" class="block text-gray-700">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?= $adresse ?? '' ?>" class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>

        <!-- Téléphone -->
        <div class="mb-4 text-left">
            <label for="telephone" class="block text-gray-700">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" value="<?= $telephone ?? '' ?>" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>

        <!-- Date de naissance -->
        <div class="mb-4 text-left">
            <label for="datenaissance" class="block text-gray-700">Date de naissance :</label>
            <input type="date" id="datenaissance" name="datenaissance" value="<?= $datenaissance ?? '' ?>" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>

        <!-- Genre -->
        <div class="mb-4 text-left">
            <label class="block text-gray-700">Genre :</label>
            <label class="inline-flex items-center">
                <input type="radio" name="genre" value="masculin" <?= ($genre === 'masculin') ? 'checked' : '' ?> class="mr-2"> Masculin
            </label>
            <label class="inline-flex items-center ml-4">
                <input type="radio" name="genre" value="feminin" <?= ($genre === 'feminin') ? 'checked' : '' ?> class="mr-2"> Féminin
            </label>
        </div>

        <!-- Langues parlées -->
        <div class="mb-4 text-left">
            <label class="block text-gray-700">Langues parlées :</label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="langues[]" value="francais" <?= in_array('francais', $langues) ? 'checked' : '' ?> class="mr-2"> Français
            </label>
            <label class="inline-flex items-center ml-4">
                <input type="checkbox" name="langues[]" value="anglais" <?= in_array('anglais', $langues) ? 'checked' : '' ?> class="mr-2"> Anglais
            </label>
            <label class="inline-flex items-center ml-4">
                <input type="checkbox" name="langues[]" value="espagnol" <?= in_array('espagnol', $langues) ? 'checked' : '' ?> class="mr-2"> Espagnol
            </label>
        </div>

        <!-- Niveau d'étude -->
        <div class="mb-4 text-left">
            <label for="etudes" class="block text-gray-700">Niveau d'étude :</label>
            <select id="etudes" name="etudes" required class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
                <option value="">Sélectionnez votre niveau d'étude</option>
                <option value="lycee" <?= ($etudes === 'lycee') ? 'selected' : '' ?>>Lycée</option>
                <option value="universite" <?= ($etudes === 'universite') ? 'selected' : '' ?>>Université</option>
                <option value="master" <?= ($etudes === 'master') ? 'selected' : '' ?>>Master</option>
                <option value="doctorat" <?= ($etudes === 'doctorat') ? 'selected' : '' ?>>Doctorat</option>
            </select>
        </div>

        <!-- Intérêts -->
        <div class="mb-4 text-left">
            <label for="interets" class="block text-gray-700">Vos intérêts :</label>
            <textarea id="interets" name="interets" rows="4" class="resize-none w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500"><?= $interets ?? '' ?></textarea>
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center">
            <input type="submit" name="editer" value="Modifier" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 cursor-pointer w-full">
        </div>
    </form>
</div>

<?php
require_once "header-and-footer/footer.php";
?>