<?php
require_once "database.php";

$sql = "SELECT* FROM `student`";
// $requete = $connect->query($sql);
// $requete = $db->query($sql);
$requete = $db->prepare($sql);

$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_ASSOC);
echo "<pre>";
// var_dump(value: $result);
echo "<pre>";


// if ($result->rowCount() > 0) {
// if ($requete->rowCount()> 0) {



// if ($requete->rowCount() > 0) {
if (count($result) > 0) {
    foreach ($result as $row) {
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
    <title>table</title>
</head>
<body>
   <table>
    <thead>
        <tr>
            <th>id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>mail</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($result as $row):
        ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name']  ?></td>
            <td><?php echo $row['prenom']?></td>
            <td><?php echo $row['mail']?></td>
            <td><?php echo $row['password']?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
   </table> 
</body>
</html>