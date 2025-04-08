
<?php
session_start();
require_once "database.php"; // Assurez-vous que ce fichier contient la connexion à votre base de données

// Vérification du rôle de l'utilisateur

if ($_SESSION['role'] != 'admin') {
  header("Location: index.php");  
}

// Traitement de l'ajout d'un étudiant
if (isset($_POST['create']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
  $pseudo  = trim($_POST['pseudo']) ?? "";
  $mail = trim($_POST['mail']) ?? "";
  
  if (!empty($pseudo) && filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $stmt = $db->prepare("INSERT INTO membres (pseudo, mail) VALUES (?, ?)");
      $stmt->execute([$pseudo, $mail]);
      $_SESSION['message'] = "Étudiant ajouté avec succès !";
      header("Location: gestion-students.php");
      exit;
  } else {
      $_SESSION['message'] = "Veuillez renseigner un nom et un mail valide.";
  }
}

// Récupérer la liste des étudiants
$stmt = $db->query("SELECT * FROM membres ORDER BY id DESC");
$membres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des étudiants</title>
  <!-- Intégration de Tailwind CSS v4 -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 p-14">
  <div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold text-green-700 text-center mb-6">Gestion des étudiants</h1>

    <?php if (isset($_SESSION['message'])): ?>
    <div class="bg-green-200 text-green-800 p-3 rounded mb-4 text-center">
      <?= $_SESSION['message']; unset($_SESSION['message']); ?>
    </div>
    <?php endif; ?>

    <!-- Formulaire d'ajout d'un étudiant -->
    <div class="bg-white shadow-lg rounded-lg p-10 mb-6">
      <h2 class="text-2xl font-bold text-green-700 mb-4">Ajouter un étudiant</h2>
      <form action="" method="POST" class="space-y-4">
        <input type="hidden" name="action" value="add">
        <div>
          <label for="name" class="block text-green-700 font-medium">Nom :</label>
          <input type="text" id="name" name="pseudo" placeholder="Nom de l'étudiant"
            class="w-full px-4 py-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div>
          <label for="email" class="block text-green-700 font-medium">Email :</label>
          <input type="email" id="email" name="mail" placeholder="Email de l'étudiant"
            class="w-full px-4 py-2 border border-green-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>
        <div class="text-center">
          <button type="submit" name="create" class=" bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600
            transition-colors">Ajouter</button>
        </div>
      </form>
    </div>

    <!-- Liste des étudiants -->
    <div class="bg-white shadow-lg rounded-lg p-10">
      <h2 class="text-2xl font-bold text-green-700 mb-4">Liste des étudiants</h2>
      <table class="min-w-full divide-y divide-green-200">
        <thead class="bg-green-100">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-medium text-green-700">ID</th>
            <th class="px-6 py-3 text-left text-sm font-medium text-green-700">Nom</th>
            <th class="px-6 py-3 text-left text-sm font-medium text-green-700">Email</th>
            <th class="px-6 py-3 text-left text-sm font-medium text-green-700">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-green-100">
          <?php foreach ($membres as $student): ?>
          <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700"><?= htmlspecialchars($student['id']) ?></td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700"><?= htmlspecialchars($student['pseudo']) ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-700"><?= htmlspecialchars($student['mail']) ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm">
              <!-- Liens pour éditer et supprimer (pages à créer séparément) -->

              <a href="delete_student.php?id=<?= $student['id'] ?>" class="text-red-600 hover:text-red-800"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">Supprimer</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</body>

</html>