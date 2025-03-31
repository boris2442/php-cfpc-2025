<?php

require_once "database.php";
$message = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `users` WHERE id=:id";
    $requete = $db->prepare($sql);
    $requete->bindParam(':id', $id);

    $requete->execute();
    // $message = "Etudiant dont 'iid est   $id   supprimé avec succès";
    if ($requete->rowCount() > 0) {
        $message = "Etudiant dont l'id est $id supprimé avec succès";
        // header("Location: index.php");
        header("refresh:3;url=index.php");
    } else {
        $message = "Aucun étudiant trouvé";
    }
}





?>





<?php
$title="deleted";
require_once "header-and-footer/header.php";
?>
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md flex justify-center items-center">
            <h1 class="text-2xl font-bold mb-6 text-red-600">Supprimer un Étudiant</h1>
            <?php if (isset($message)) : ?>
                <p class="mb-4 text-center text-red-500"><?= htmlspecialchars($message);
                                                            ?></p>
            <?php endif; ?>
            <script type="text/javascript">
                // Redirige vers la page d'accueil après 3 secondes
                setTimeout(function() {
                    window.location.replace("index.php");
                }, 3000);
            </script>
        </div>
    
<?php
require_once "header-and-footer/footer.php";
?>