<?php
// session_start();
//si la session n'est pas demarree
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="includes/logo.png">

    <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Parkinsans:wght@300..800&family=Playwrite+HU:wght@100..400&family=Playwrite+PE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
    <title>manager Accounts users</title>
</head>

<body>
    <header>
        <div class="logo">
            <h2><a style="color:white" href="index.php">Compte utilisateur</a></h2>
        </div>
        <nav>
            <ul><?php
                if (isset($_SESSION['auth'])): ?>
                    <li><a id="gcu" href="logout.php">Se deconnecter</a></li>
                <?php else: ?>

                    <li><a href="register.php">S'inscrire</a></li>

                    <li><a href="login.php">Se connecter</a></li>
                <?php endif ?>
            </ul>
        </nav>

    </header>
    <span>
        <h1>Gestion de comptes utilisateurs</h1>
    </span>
    <?php
    if (isset($_SESSION['flash'])) {
        foreach ($_SESSION['flash'] as $type => $message) {
            echo '<div class="alert alert-' . $type . '">' . $message . '</div>';
        }
        // Clear the flash message after displaying it 
        unset($_SESSION['flash']);
    }






    ?>