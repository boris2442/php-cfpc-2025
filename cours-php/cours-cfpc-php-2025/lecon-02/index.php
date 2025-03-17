<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenue sur mon site</h1>
    <?php
    session_start();
    if($_SESSION['errors']){
        
    $errors= $_SESSION['errors'];
   
    foreach($errors as $error){
   echo $error;
    }
    }
    ?>
</body>
</html> 