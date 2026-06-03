<?php
session_start();
require_once "../database.php";

$loggedInUserId = (int)($_SESSION["user_id"] ?? 0);
$recipeId = (int)($_POST["recipe_id"] ?? 0);

if ($loggedInUserId <= 0 || $recipeId <= 0) {
    die("Hozzáférés megtagadva.");
}

/*
  Megnézzük ki a recept tulajdonosa
*/
$stmt = mysqli_prepare(
    $conn,
    "SELECT created_by, image_url FROM recipes WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $recipeId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$recipe = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$recipe) {
    die("A recept nem található.");
}

/*
  Csak a tulajdonos törölheti
*/
if ((int)$recipe["created_by"] !== $loggedInUserId) {
    die("Nincs jogosultságod a recept törléséhez.");
}

/*
  Kép törlése (ha van)
*/
if (!empty($recipe["image_url"])) {
    $imagePath = "../imgs/" . $recipe["image_url"];

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

/*
  Kapcsolódó adatok törlése
*/
$stmt = mysqli_prepare($conn, "DELETE FROM recipe_ingredients WHERE recipe_id = ?");
mysqli_stmt_bind_param($stmt, "i", $recipeId);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($conn, "DELETE FROM recipe_steps WHERE recipe_id = ?");
mysqli_stmt_bind_param($stmt, "i", $recipeId);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($conn, "DELETE FROM recipe_likes WHERE recipe_id = ?");
mysqli_stmt_bind_param($stmt, "i", $recipeId);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

/*
  Maga a recept
*/
$stmt = mysqli_prepare($conn, "DELETE FROM recipes WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $recipeId);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

echo "
<script>
alert('A recept sikeresen törölve!');
window.location.href = '../receptek/receptek.php';
</script>
";