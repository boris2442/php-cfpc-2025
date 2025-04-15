<?php
session_start();
require_once('./includes/database.php');
require_once('./includes/clean_input.php');
require_once('./includes/functions.php');
//recuperation de l'id de l'utilisateur
// Check if the user is logged in
$userId=$db->lastInsertId(); // Get the last inserted ID (user ID) from the database


$userId=$_GET['id'] ?? null; // Get the user ID from the URL parameter
var_dump($_GET['id']);
var_dump($userId);
$token=$_GET['token']; // Get the token from the URL parameter
//recupere l'id de l'utilisateur a partir du token
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");

$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($user);
// echo "</pre>";


if($user && $user['confirmation_token']==$token){
    // echo "<pre>";
    // print_r($user);
    // echo "</pre>";
    // echo "le token est valide";
    // var_dump($user['confirmed_token']);
    // var_dump($token);
    $stmt = $db->prepare("UPDATE users SET confirmation_token = NULL, confirmate_at=NOW() WHERE id = ?");
    $stmt->execute([$userId]);
    $_SESSION['flash']['success'] = "Votre compte a été confirmé avec succès !";
    $_SESSION['auth'] = $userId; // Store the user ID in the session
    header('Location: login.php');
} else {
    $_SESSION['flash']['error'] = "Le lien de confirmation est invalide ou a déjà été utilisé.";
    header('Location: login.php');
    exit();
}










// if ($userId) {
//     $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
//     $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
//     $stmt->execute();
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($user) {
//         // Display user information
//         echo "<h1>User Information</h1>";
//         echo "<p>ID: " . htmlspecialchars($user['id']) . "</p>";
//         echo "<p>Username: " . htmlspecialchars($user['username']) . "</p>";
//         echo "<p>Email: " . htmlspecialchars($user['email']) . "</p>";
//         // Add more fields as needed
//     } else {
//         echo "<p>User not found.</p>";
//     }
// } else {
//     echo "<p>No user ID provided.</p>";
// }






?>