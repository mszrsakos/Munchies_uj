<?php
session_start();
include_once('../database.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../bejelentkezes/bejelentkezes.php");
    exit;
}

$email = $_SESSION['email'];

$stmt = $conn->prepare(
    "SELECT profile_picture, profile_picture_type
     FROM users
     WHERE email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($image, $type);
$stmt->fetch();

if ($image === null) {
    // Default profile picture
    header("Content-Type: image/png");
    readfile("../imgs/profil_kep-removebg-preview.png");
} else {
    header("Content-Type: " . $type);
    echo $image;
}

$stmt->close();
$conn->close();
exit;
?>