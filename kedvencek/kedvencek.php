<?php
session_start();
require_once "../database.php";

$userId = $_SESSION["user_id"] ?? 0;

if (!$userId) {
    header("Location: ../bejelentkezes/bejelentkezes.php");
    exit;
}

$sql = "
  SELECT r.id, r.title, r.image_url
  FROM recipe_likes rl
  INNER JOIN recipes r ON r.id = rl.recipe_id
  WHERE rl.user_id = ?
  ORDER BY rl.id DESC
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

$favorites = [];
while ($row = mysqli_fetch_assoc($res)) {
    $favorites[] = $row;
}

mysqli_stmt_close($stmt);

function h($s){
    return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kedvenc receptek</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="kedvencek.css">
    <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
    
</head>
<body>

<?php include("../header/header.html"); ?>

<div class="container">
    <h1>Kedvenc receptek</h1>

    <?php if (count($favorites) > 0): ?>
        <div class="grid">
            <?php foreach ($favorites as $fav): ?>
                <?php
                    $img = !empty($fav["image_url"])
                        ? "../imgs/" . ltrim($fav["image_url"], "/")
                        : "";
                ?>
                <a class="card" href="../recept/recept.php?id=<?= (int)$fav["id"] ?>">
                    <?php if ($img): ?>
                        <img src="<?= h($img) ?>" alt="">
                    <?php endif; ?>
                    <h3><?= h($fav["title"]) ?></h3>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="ures">Még nincs egyetlen kedvenc recepted sem.</p>
    <?php endif; ?>
</div>
<footer><?php include("../footer/footer.html"); ?></footer>


</body>
</html>