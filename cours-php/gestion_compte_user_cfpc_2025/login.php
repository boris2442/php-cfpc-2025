<?php
session_start();
require_once './includes/database.php';
 ?>
<?php require_once './includes/header.php'; ?>
<div class=" content">
    <div class="container">
        <div class="header">
            <h2>Se Connecter</h2>
        </div>
        <form action="" class="form" id="form" method="post">
            <div class="form-control">
                <label for="username">Nom d'utilisateur ou l'émail</label>
                <input type="text" id="username" placeholder="rostodev" autocomplete="off" name="username">

            </div>

            <div class=" form-control">
                <label for="password">Mot de passe <a class="passforget" href="remember.php">(J'ai oublié mon mot de
                        passe)</a>
                </label>
                <input type="password" id="password" name="password">

            </div>
            <div class="form-controlg remember">
                <label for="remember"> <input type="checkbox" name="remember" value="1"> Se souvenir de moi</label>


            </div>

            <button type="submit"><i class="fa fa-user-plus"></i> Se connecter</button>
        </form>

    </div>
</div>
<?php
require_once './includes/footer.php';
?>