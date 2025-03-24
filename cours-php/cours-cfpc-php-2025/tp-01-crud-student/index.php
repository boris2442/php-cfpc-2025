<?php
require_once "database.php";
$sql = "SELECT* FROM `students2`";
$requete = $db->prepare($sql);

$requete->execute();

// $users=$requete->fetchAll(PDO::FETCH_ASSOC);
$users = $requete->fetchAll(PDO::FETCH_ASSOC);
if (count($users) > 0) {
    echo "Nombre d'etudiants: " . count($users);
} else {
    echo "Aucun etudiant trouve";
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <title>TP-01-Crud-student</title>
</head>

<body class="bg-green-100 p-12">
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-green-900 text-center mb-6">CRUD student en PHP et tailwind css V4</h1>

        <!-- Formulaire de recherche -->
        <form method="GET" action="" class="mb-4">

            <a class=" my-5 px-4 py-2 mr-5 bg-green-600 text-white rounded hover:bg-green-700" href="create.php">Créer un
                nouvel étudiant</a>

            <a class=" my-5 px-4 py-2 mr-5 bg-green-600 text-white rounded hover:bg-green-700" href="http://localhost/php-2025/cours-php/cours-cfpc-php-2025/tp-01-crud-student/">Actualiser
            </a>

            <input type=" text" name="search" placeholder="Rechercher par nom ou email" value=""
                class="my-5 px-4 py-2 border rounded-lg w-full md:w-1/3">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Rechercher</button>
        </form>

        <!-- Tableau des étudiants -->
        <table class="min-w-full divide-y divide-green-200 bg-white shadow rounded-lg">
            <thead class="bg-green-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Prénom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Mail</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-green-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-green-100">

                <?php foreach ($users as $user) : ?>
                    <tr class="hover:bg-green-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900"><?php echo htmlspecialchars($user["nom"]) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900"><?php echo htmlspecialchars($user["prenom"]) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-900"><?php echo htmlspecialchars($user["mail"]) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a class="text-green-600 hover:text-green-900 font-medium mr-4" href="update.php? id= <?php echo $user['id']; ?>">Modifier</a>
                            <a class="text-red-600 hover:text-red-900 font-medium" href="delete.php? id= <?php echo $user['id']; ?>"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>


    </div>
</body>

</html>