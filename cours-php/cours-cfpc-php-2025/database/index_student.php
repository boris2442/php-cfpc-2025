<?php
require_once "database.php";

$sql = "SELECT* FROM `student`";
// $requete = $connect->query($sql);
// $requete = $db->query($sql);
$requete = $db->prepare($sql);

$requete->execute();
$result = $requete->fetchAll();
echo "<pre>";
var_dump(value: $result);
echo "<pre>";


if ($requete->rowCount() > 0) {
// if ($result->rowCount() > 0) {
    // if ($requete->rowCount()> 0) {



    foreach ($requete as $row) {
    // foreach ($result as $row) {
        echo " id:" . $row['id'] . " <br>";
        echo " Nom:" . $row['name'] . " <br>";
        echo " prenom:" . $row['prenom'] . " <br>";
        echo " mail:" . $row['mail'] . " <br>";
        echo " password:" . $row['password'] . " <br>";
    }
} else {
    echo "Aucun etudiant trouvée dans la database";
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