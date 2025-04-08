<?php
require_once './includes/database.php';
?>
<?php require_once './includes/header.php'; ?>
<div class=" content">
    <div class="container">
        <div class="header">
            <h2>Rappel du mot de passe</h2>
        </div>

        <form action="" class="form" id="form" method="post">
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="rostodev" autocomplete="off" name="email">
            </div>

            <button type="submit"> Soumettre</button>
        </form>

    </div>
</div>
<?php
require_once './includes/footer.php';
?>