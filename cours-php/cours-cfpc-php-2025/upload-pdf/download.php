<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT name, type, content FROM pdf_files2 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        header("Content-Type: " . $file['type']);
        header("Content-Disposition: attachment; filename=\"" . $file['name'] . "\"");
        echo $file['content'];
    } else {
        echo "<script>alert('Fichier non trouvé.'); window.history.back();</script>";
    }
}
?>
