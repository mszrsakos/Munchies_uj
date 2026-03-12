<?php
session_start();
require_once "../database.php";

$userId = $_SESSION["user_id"] ?? 0;

if (!$userId) {
    header("Location: ../bejelentkezes/bejelentkezes.php");
    exit;
}

$recipeId = (int)($_POST["recipe_id"] ?? 0);

if ($recipeId <= 0) {
    header("Location: ../fooldal/index.php");
    exit;
}

$stmt = mysqli_prepare($conn, "SELECT id FROM recipe_likes WHERE user_id=? AND recipe_id=?");
mysqli_stmt_bind_param($stmt, "ii", $userId, $recipeId);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (mysqli_fetch_assoc($res)) {

    $stmt = mysqli_prepare($conn, "DELETE FROM recipe_likes WHERE user_id=? AND recipe_id=?");
    mysqli_stmt_bind_param($stmt, "ii", $userId, $recipeId);
    mysqli_stmt_execute($stmt);

} else {

    $stmt = mysqli_prepare($conn, "INSERT INTO recipe_likes (user_id, recipe_id) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ii", $userId, $recipeId);
    mysqli_stmt_execute($stmt);
}

header("Location: recept.php?id=".$recipeId);
exit;
