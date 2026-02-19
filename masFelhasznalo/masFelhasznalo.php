<?php
session_start();
require_once "../database.php";

$userId = (int)($_GET["id"] ?? 0);
if ($userId <= 0) {
    die("Érvénytelen felhasználói azonosító.");
}

// Felhasználó adatainak lekérdezése
$sql = "SELECT username, email, profile_image_url, display, about_me FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    die("A felhasználó nem található.");
}

// Ellenőrizd, hogy a bejelentkezett felhasználó azonos-e a megadott felhasználóval
$isOwnProfile = isset($_SESSION["user_id"]) && $_SESSION["user_id"] === $userId;
$profileLink = $isOwnProfile 
    ? "../profil/profil.php" 
    : "../masFelhasznalo/masFelhasznalo.php?id=" . $userId;
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($user["display"] ?? $user["username"]) ?> profilja</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="masFelhasznalo.css">
    <link rel="stylesheet" href="../footer/footer.css">
</head>
<body>
    <?php include("../header/header.html"); ?>

    <div class="profil_kep">
        <img src="<?= htmlspecialchars(!empty($user["profile_image_url"]) ? $user["profile_image_url"] : '../imgs/profil_kep-removebg-preview.png') ?>" alt="Profilkép" class="profile-picture">
        <h1><?= htmlspecialchars($user["display"] ?? $user["username"]) ?></h1>
        <p>Email: <?= htmlspecialchars($user["email"]) ?></p>
        <p>Rólam: <?= htmlspecialchars($user["about_me"] ?? "Nincs megadva.") ?></p>
    </div>

    <?php include("../footer/footer.html"); ?>
</body>
</html>