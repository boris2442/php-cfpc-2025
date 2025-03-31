<?php
require_once "database.php";
$sql = "SELECT * FROM `users`";

$requete = $db->query($sql);

$students = $requete->fetchAll(PDO::FETCH_ASSOC);



$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";
// var_dump($search);

// //requette sql pour recuperer les etudiants en fonction de la recherche(mail et nom)
$sql = "SELECT * FROM `users`";
if (!empty($search)) {
    $sql .= "WHERE  nom LIKE '%$search%' OR prenom LIKE  '%$search%' OR email LIKE '%$search%' ";
}
// $sql .= " ORDER BY id DESC";
$requete = $db->prepare($sql);

$requete->execute();
$students = $requete->fetchAll();
// var_dump($users);


if (count($students) > 0) {
    echo "Nombre d'etudiants: " . count($students);
} else {
    echo "Aucun étudiant trouvé";
}


?>










<?php
$title="home";
require_once "header-and-footer/header.php";
?>

<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold text-green-900 text-center mb-6">Liste des
        Étudiants (Student2)</h1>
    <!-- Formulaire de recherche -->
    <form method="get" action="" class="mb-4 flex flex-col md:flex-row
items-center gap-4">
        <div class="flex flex-col md:flex-row items-center gap-4">
            <a href="create2.php" class="px-4 py-2 bg-green-600 text-white rounded
hover:bg-green-700">
                Créer un nouvel étudiant
            </a>
            <a href="http://localhost/php-2025/cours-php/cours-cfpc-php-2025/tp-03-crud-students-complet/" class="px-4 py-2 bg-green-600 text-white rounded
hover:bg-green-700">
                Actualiser
            </a>
        </div>
        <div class="flex flex-col md:flex-row items-center gap-4">
            <input type="text" name="search" placeholder="Rechercher par nom ou
email"
                value="" class="px-4 py-2 border
rounded-lg w-full md:w-1/3">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded
hover:bg-green-700">
                Rechercher
            </button>
        </div>
    </form>
    <!-- Tableau des étudiants -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead class="bg-green-200">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">ID</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Nom</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Prénom</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Adresse</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Téléphone</th>

                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Date de naissance</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Genre</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Langues</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Niveau d'étude</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Intérêts</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Photo</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Document</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Créé le</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-green-100">
                <?php foreach ($students as $student) : ?>
                    <tr class="hover:bg-green-50">
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['id'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['nom'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['prenom'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['email'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['adresse'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['telephone'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['datenaissance'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['genre'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['langues'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['etudes'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900"><?= $student['interets'] ?></td>
                        <td class="px-4 py-2 text-sm text-green-900">

                            <img src="data:image/png;base64,<?php echo base64_encode($student['photo'] ?? ''); ?>"
                                alt="Image de <?php echo htmlspecialchars($student['nom'] ?? ''); ?>"
                                style="width: 80px; height: 80px;" class="object-cover">



                        </td>
                        <td class="px-4 py-2 text-sm text-green-900">
                            <?php if (!empty($student['document'])) : ?>
                                <a href="<?= htmlspecialchars($student['document']) ?>" target="_blank" class="text-blue-600 hover:underline">
                                    Ouvrir le document
                                </a>
                            <?php else : ?>
                                Aucun document
                            <?php endif; ?>

                        </td>

                        <td class="px-4 py-2 text-sm text-green-900"><?php echo $student['create']  ?></td>
                        <td class="px-4 py-2 text-sm">
                            <a href="update.php?id= <?php echo $student['id']; ?>"
                                class="text-green-600 hover:text-green-900 font-medium mr2">Modifier</a>
                            <a href="delete.php?id=<?php echo $student['id']; ?>"

                                class="text-red-600 hover:text-red-900 font-medium" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once "header-and-footer/footer.php";
?>