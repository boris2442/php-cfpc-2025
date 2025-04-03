<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de PDF</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-xl font-semibold mb-4 text-center">Uploader un fichier PDF</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="space-y-4">
            <input type="file" name="file" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-md p-2" accept="application/pdf" required>
            <button type="submit" name="upload" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">Uploader</button>
        </form>
    </div>
</body>
</html>
