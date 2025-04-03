<?php
session_start();
require_once "database.php";

// Vérifier si un cookie "remember_me" existe pour une connexion automatique
if (isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];

    // Rechercher l'utilisateur dans la base de données avec son token
    $requser = $db->prepare('SELECT * FROM utilisateurs WHERE remember_token = ?');
    $requser->execute([$token]);
    $user = $requser->fetch();

    if ($user) {
        // Authentification automatique
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header('Location: dashboard.php');
        exit();
    }
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']); // Vérifie si la case est cochée

    // Vérifier si l'utilisateur existe
    $requser = $db->prepare('SELECT * FROM utilisateurs WHERE email = ?');
    $requser->execute([$email]);
    $user = $requser->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Authentification réussie
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Si "Se souvenir de moi" est coché, on crée un cookie avec un token sécurisé
        if ($remember_me) {
            $token = bin2hex(random_bytes(16)); // Générer un token aléatoire

            // Enregistrer le token en base de données
            $updateToken = $db->prepare('UPDATE utilisateurs SET remember_token = ? WHERE id = ?');
            $updateToken->execute([$token, $user['id']]);

            // Créer un cookie avec le token qui expire dans 30 jours
            setcookie('remember_me', $token, time() + 30 * 24 * 60 * 60, "/", "", false, true);
        }

        // Rediriger vers le tableau de bord
        header('Location: dashboard.php');
        exit();
    } else {
        $error_message = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

<h2>Connexion</h2>

<?php if (isset($error_message)) { ?>
    <p style="color: red;"><?= $error_message; ?></p>
<?php } ?>

<form action="login.php" method="POST">
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>

    <label for="remember_me">
        <input type="checkbox" name="remember_me" id="remember_me"> Se souvenir de moi
    </label>

    <button type="submit">Se connecter</button>
</form>

</body>
</html>
