<?php
session_start();
require_once "../database.php";

$userId = (int)($_GET["id"] ?? 0);
if ($userId <= 0) {
    die("Érvénytelen felhasználói azonosító.");
}


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
/* ===== Felhasználó receptjei ===== */
$stmt = mysqli_prepare($conn, "
    SELECT id, title, image_url
    FROM recipes
    WHERE created_by = ?
    ORDER BY created_at DESC
");
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$userRecipes = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);


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
    <!-- <div class="masikFelhasznaloTartalom"> -->
        <div class="profil_kep">
            <img src="<?= htmlspecialchars(!empty($user["profile_image_url"]) ? $user["profile_image_url"] : '../imgs/profil_kep-removebg-preview.png') ?>" alt="Profilkép" class="profile-picture">
            <h1><?= htmlspecialchars($user["display"] ?? $user["username"]) ?></h1>
            <p>Email:</p>
            <p id="masProfilEmail"><?= htmlspecialchars($user["email"]) ?></p>
            <p>Rólam:</p>
            <p id="masProfilRolam"><?= htmlspecialchars($user["about_me"] ?? "Nincs megadva.") ?></p>
        </div>

        <div class="receptek">
            <h2>Feltöltött receptek</h2>

            <?php if (mysqli_num_rows($userRecipes) > 0): ?>
                
                    <?php while ($row = mysqli_fetch_assoc($userRecipes)): ?>
                        <div class="img-wrapper">
                            <a class="kepLink" href="../recept_sema/recept.php?id=<?= (int)$row["id"] ?>">
                                <img class="kep" src="../imgs/<?= htmlspecialchars($row["image_url"]) ?>" alt="">
                                <div class="content fade"><?= htmlspecialchars($row["title"]) ?></div>
                            </a>
                        </div>
                    <?php endwhile; ?>
               
            <?php else: ?>
                <p id="nincsRecept">A felhasználónak még nincs feltöltött receptje.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include("../footer/footer.html"); ?>
</body>
</html>