<?php
require_once './includes/database.php';
session_start();

?>

<?php require_once './includes/header.php'; ?>
<div class=" content">
    <div class="container">
        <div class="header">
            <h2>Réinitialiser votre mot de passe</h2>
        </div>
<form action="" class="form" id="form" method="post" enctype="multipart/form-data">
            

            <div class="form-control">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password">

            </div>

            <div class="form-control">
                <label for="confirm_password">Confirmation du mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password">

            </div>
            
            <button type="submit"> Réinitialiser votre mot de passe</button>
        </form>
        </div>
</div>
<?php
require_once './includes/footer.php';
?>