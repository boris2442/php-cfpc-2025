<?php
session_start();
require_once('./includes/database.php');
require_once('./includes/clean_input.php');
require_once('./includes/functions.php');
//recuperation de l'id de l'utilisateur
// Check if the user is logged in
$userId=$_GET['id'] ?? null; // Get the user ID from the URL parameter

$token=$_GET['token']; // Get the token from the URL parameter
//recupere l'id de l'utilisateur a partir du token
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");

$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($user);











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