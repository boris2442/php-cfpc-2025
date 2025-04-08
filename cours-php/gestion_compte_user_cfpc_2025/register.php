<?php
session_start();
require_once('./includes/database.php');
require_once('./includes/clean_input.php');
if ($_POST) {
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";


    

    //recuperation des erreurs sous forme de tableau
    $errors = [];
    if (empty($_POST['username']) || !preg_match("/^[a-zA-Z0-9_]{3,20}$/", $_POST['username'])) {
        $errors['username'] = "Le nom  doit contenir entre 3 et 20 caractères alphanumériques";
        var_dump($errors['username']);
    } else {
        $username = htmlspecialchars(trim($_POST['username']));
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->rowCount() > 0) {
            $errors['username'] = "Ce nom d'utilisateur existe déjà";
            var_dump($errors['username']);
        }
    }
    //email
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email est invalide";
    } else {
        $email = htmlspecialchars(trim($_POST['email']));
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $errors['email'] = "Cet email existe déjà";
        }
    }

    ////password

    // if (
    //     empty($_POST['password']) ||
    //     !preg_match(
    //         "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/",
    //         $_POST['password']
    //     )
    // ) {
    //     $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre";
    // } elseif ($_POST['password']!== $_POST['confirm_password']) {
    //     $errors['confirm_password'] = "Les mots de passe ne correspondent pas";
    // }



    if (
        empty($_POST['password']) ||
        !preg_match(
            "/[a-zA-Z0-9_\/]{8,}$/",
            $_POST['password']
        )
    ) {
        $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre";
    } elseif (trim($_POST['password']) !== trim($_POST['confirm_password'])) {
        $errors['confirm_password'] = "Les mots de passe ne correspondent pas";
    }
    //INSERT INTO
    if (empty($errors)) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        // $_SESSION['success'] = "Inscription réussie";
        header('location:login.php');
        exit();
    }
}





?>
<?php require_once './includes/header.php'; ?>


<div class="content">
    <div class="container">
        <div class="header">
            <h2>S'inscrire</h2>
        </div>


        <?php
        if (!empty($errors)) {
            echo '<div style="color:white; text-align: center; background-color:#ff6c6c;padding:2px 7px; margin-bottom:10px; font-size:16px;">' . reset($errors) . '</div>';
        }
        ?>
        <form action="" class="form" id="form" method="post" enctype="multipart/form-data">
            <div class="form-control">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" placeholder="rostodev" name="username" autocomplete="off"
                    value="<?= isset($_POST['username']) ? $_POST['username'] : ''; ?>">

            </div>

            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="rostodev@gmail.com" name="email"
                    value="<?= isset($_POST['email']) ? clean_input($_POST['email']) : ''; ?>" autocomplete="off">
            </div>

            <div class="form-control">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password">

            </div>

            <div class="form-control">
                <label for="confirm_password">Confirmation du mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password">

            </div>


            <button type="submit"> S'inscrire</button>

        </form>

    </div>
</div>
<?php
require_once './includes/footer.php';
?>