<?php
session_start();
require_once './includes/database.php';
require_once './includes/clean_input.php';
require_once './includes/functions.php';
// $error = [];
if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $sql = "SELECT * FROM users WHERE (username = :username OR email = :username) AND confirmate_at IS NOT NULL";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $_POST['username']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['auth'] = $user['id'];
            $_SESSION['flash']['success'] = "Bienvenue {$user['username']} !";
            if (!empty($_POST['remember'])) {
                // setcookie('remember', $user['id'] . '==' . $user['password'], time() + 60 * 60 * 24 * 7, null, null, false, true);
                setcookie('email', $user['email'], time() + 365 * 24 * 3600, "/", null, false, true); // Cookie valide pendant 1 an
            }else {
                // Si la case n'est pas cochée, supprimer le cookie existant
                setcookie('email', '', time() - 3600, "/");
            }
            header('Location: index.php');
            exit();
        } else {
           $_SESSION['flash']['error'] = " nom et ou Mot de passe incorrect !";
        }
    } else {
        $_SESSION['flash']['error']= "Nom d'utilisateur ou mot de passe incorrect !";
    }
}



?>
<?php require_once './includes/header.php'; ?>
<div class=" content">
    <div class="container">
        <div class="header">
            <h2>Se Connecter</h2>
        </div>
        <form action="" class="form" id="form" method="post">
            <div class="form-control">
                <label for="username">Nom d'utilisateur ou l'émail:</label>
                <input type="text" id="username" placeholder="rostodev" autocomplete="off" name="username" value="<?php echo isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email']) : ''; ?>">

            </div>

            <div class=" form-control parent-icon-eye">
                <label for="password">Mot de passe <a class="passforget" href="remember.php">(J'ai oublié mon mot de
                        passe)</a>
                </label>
                <i class="fa-solid fa-eye  icon-remember" id="togglePassword"></i>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-controlg remember">
          
                <label for="remember"> <input type="checkbox" name="remember" value="1"> Se souvenir de moi</label>


            </div>

            <button type="submit"><i class="fa fa-user-plus"></i> Se connecter</button>
        </form>

    </div>
</div>
<script src="./javascript/script.js"></script>
<?php
require_once './includes/footer.php';
?>