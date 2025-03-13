<?php
if (isset($_POST['create'])) {
    echo "formulaire ok";
    // if (empty($_POST['nom'])) {
    //     echo "veuillez saisir le nom";
    // }
    // $nom_student = $_POST['nom'];
    // echo "nom: $nom_student</br>";
    // if (empty($_POST['prenom'])) {
    //     echo "veuillez remplir le prenom";
    // }
    // if (empty($_POST['mail'])) {
    //     echo "Veuillez remplir l'email";
    // }
    // $prenom_student = $_POST['prenom'];
    // echo "prenom: $prenom_student</br>";
    // $mail_student = $_POST['mail'];
    // echo "mail: $mail_student</br>";
  $message="";
    if (empty($_POST['nom'])){
        
        $message="veuillez saisir le nom";
        
    }else if(empty($_POST['prenom'])){
        $message="veuillez saisir le nom";
     
    }else if(empty($_POST['mail'])){
        $message="veuillez saisir le nom";
       
    }else{
        $nom_student = $_POST['nom'];
        echo "nom: $nom_student</br>";
        $prenom_student = $_POST['prenom'];
        echo "prenom: $prenom_student</br>";
        $mail_student = $_POST['mail'];
        echo "mail: $mail_student</br>";
    }
}



?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
</head>

<body>
  
   

    <form action="" method="post" class="bg-white p-6 rounded shadow max-w-md mx-auto">
        
         <div class="bg-red-500 p-5 text-left mb-3"> <?php echo "$message";   ?></div>
        
      
        <div class="mb-4">
            <input type="text" name="nom" placeholder="Nom"
                class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>
        <div class="mb-4">
            <input type="text" name="prenom" placeholder="Prénom"
                class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>
        <div class="mb-4">
            <input type="email" name="mail" placeholder="Email"
                class="w-full border border-green-300 p-2 rounded focus:outline-none focus:border-green-500">
        </div>
        <div class="text-center">
            <input type="submit" name="create" value="Créer"
                class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        </div>
    </form>

</body>

</html>