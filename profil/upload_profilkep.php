<?php
ob_start();
ini_set('display_errors', 0);
error_reporting(0);

session_start();
require_once('../database.php');
ob_clean();

if (!isset($_SESSION['email'])) {
    header("Location: profil.php");
    exit;
}

if (!isset($_FILES['profile_picture'])) {
    header("Location: profil.php");
    exit;
}

$email = $_SESSION['email'];
$file  = $_FILES['profile_picture'];

// Validate upload
if ($file['error'] !== UPLOAD_ERR_OK) {
    header("Location: profil.php");
    exit;
}

// Validate size (2MB)
if ($file['size'] > 2 * 1024 * 1024) {
    header("Location: profil.php");
    exit;
}

// Validate type
$mimeType = mime_content_type($file['tmp_name']);
$allowed  = ['image/jpeg', 'image/png', 'image/gif'];

if (!in_array($mimeType, $allowed)) {
    header("Location: profil.php");
    exit;
}

// Read image
$imageData = file_get_contents($file['tmp_name']);

// Store in DB
$stmt = $conn->prepare(
    "UPDATE users
     SET profile_picture = ?, profile_picture_type = ?
     WHERE email = ?"
);
$stmt->bind_param("sss", $imageData, $mimeType, $email);
$stmt->send_long_data(0, $imageData);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: profil.php");
exit;
?>