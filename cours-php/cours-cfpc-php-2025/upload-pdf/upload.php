<?php
require 'db.php';

if (isset($_POST['upload'])) {
    if (!empty($_FILES['file']['name'])) {
        $filename = $_FILES['file']['name'];
        $filetype = $_FILES['file']['type'];
        $filesize = $_FILES['file']['size'];
        $filetmp = $_FILES['file']['tmp_name'];

        if ($filetype == "application/pdf") {
            $filecontent = file_get_contents($filetmp);

            $sql = "INSERT INTO pdf_files2 (name, type, size, content) VALUES (:name, :type, :size, :content)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $filename);
            $stmt->bindParam(':type', $filetype);
            $stmt->bindParam(':size', $filesize);
            $stmt->bindParam(':content', $filecontent, PDO::PARAM_LOB);

            if ($stmt->execute()) {
                echo "<script>alert('Fichier téléchargé avec succès !'); window.location.href='view.php';</script>";
            } else {
                echo "<script>alert('Erreur lors de l\'upload.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Seuls les fichiers PDF sont autorisés.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Veuillez sélectionner un fichier.'); window.history.back();</script>";
    }
}
?>
