<?php
require_once "database.php";

$sql = "SELECT* FROM `student`";
$requete = $connect->query($sql);
echo "<pre>";
var_dump(value: $requete);
echo "<pre>";

foreach ($requete as $row) {
    echo " id:" . $row['id'] . " <br>";
    echo " Nom:" . $row['name'] . " <br>";
    echo " prenom:" . $row['prenom'] . " <br>";
    echo " mail:" . $row['mail'] . " <br>";
    echo " password:" . $row['password'] . " <br>";
}










?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index_student</title>
</head>

<body>

</body>

</html>