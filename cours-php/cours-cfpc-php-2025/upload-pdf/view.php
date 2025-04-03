<?php
require 'db.php';

$sql = "SELECT id, name FROM pdf_files2";
$stmt = $pdo->query($sql);
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des fichiers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-xl font-semibold mb-4 text-center">Fichiers enregistrés</h2>
        <ul class="space-y-2">
            <?php foreach ($files as $file): ?>
                <li class="flex justify-between items-center border-b pb-2">
                    <span><?php echo htmlspecialchars($file['name']); ?></span>
                    <a href="download.php?id=<?php echo $file['id']; ?>" class="text-blue-600 hover:underline">Télécharger</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="index.php" class="block text-center mt-4 text-blue-600 hover:underline">Retour</a>
    </div>
</body>
</html>
