<?php
require "database.php";
if (!empty($_POST)) {
    if (isset($_POST['email'], $_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "email non valide";
            return;
        }
        $password = $_POST['password'];
        //interogeons la data base pour savoir si l'emailexiste

        $sql="SELECT* FROM `users` WHERE ` email=$email";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>connectez vous</h2>
    <form method="POST">
        <!-- <input type="text" class="" name="name" placeholder="enter your password"> -->
        <label for="email">email</label>
        <input type="email" placeholder="enter your email" name="email">
        <label for="souvenir_de_moi">se souvenir de moi!</label>
        <input type="checkbox" name="remember_me" id="souvenir_de_moi" value="Se souvenir de moi!">
        <input type="submit" value="connectez vous">

    </form>
</body>

</html>