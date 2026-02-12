<?php
session_start();
require_once('../database.php');

if (!isset($_SESSION['email'])) {
    header("Location: profil.php");
    exit;
}

if (!isset($_FILES['profile_picture']) || $_FILES['profile_picture']['error'] !== UPLOAD_ERR_OK) {
    header("Location: profil.php");
    exit;
}

$email = $_SESSION['email'];
$file  = $_FILES['profile_picture'];

// Validate image type
$mime = mime_content_type($file['tmp_name']);
$allowed = ['image/jpeg', 'image/png'];

if (!in_array($mime, $allowed)) {
    die("Invalid image type");
}

// Create uploads directory if missing
$uploadDir = __DIR__ . '/../uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Generate filename
$ext = ($mime === 'image/png') ? 'png' : 'jpg';
$filename = 'profile_' . md5($email) . '.' . $ext;

// Full filesystem path
$fullPath = $uploadDir . $filename;

// Move uploaded file
if (!move_uploaded_file($file['tmp_name'], $fullPath)) {
    die("File upload failed");
}

// URL path (THIS is what goes in DB)
$imageUrl = '../uploads/' . $filename;

// Save URL in DB
$stmt = $conn->prepare(
    "UPDATE users SET profile_image_url = ? WHERE email = ?"
);
$stmt->bind_param("ss", $imageUrl, $email);
$stmt->execute();
$stmt->close();

header("Location: profil.php");
exit;
