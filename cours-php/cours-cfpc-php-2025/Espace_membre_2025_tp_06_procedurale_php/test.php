<?php

if(!empty($_POST)){
    $nom = $_POST['nom'];
    $text = $_POST['text'];
    echo "Nom: $nom <br>";
    echo "Text: $text <br>";
}else{
    echo "Aucun formulaire soumis";
}