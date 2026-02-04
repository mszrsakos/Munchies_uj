<?php
// ABSOLUTELY NO OUTPUT ALLOWED
ob_start();
ini_set('display_errors', 0);
error_reporting(0);

session_start();
require_once('../database.php');

// CLEAN ANY OUTPUT CAUSED BY includes (THIS IS THE FIX)
ob_clean();

$defaultImage = __DIR__ . '/../imgs/profil_kep-removebg-preview.png';

if (!isset($_SESSION['email'])) {
    header('Content-Type: image/png');
    header('Content-Length: ' . filesize($defaultImage));
    readfile($defaultImage);
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
$stmt->close();
$conn->close();

// CLEAN AGAIN just in case
ob_clean();

if (!empty($image)) {
    header("Content-Type: $type");
    header("Content-Length: " . strlen($image));
    echo $image;
    exit;
}

// FALLBACK DEFAULT
header('Content-Type: image/png');
header('Content-Length: ' . filesize($defaultImage));
readfile($defaultImage);
exit;
