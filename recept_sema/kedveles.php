<?php
session_start();
require_once "../database.php";

$userId = $_SESSION["user_id"] ?? 0;

if (!$userId) {
    http_response_code(401);
    echo json_encode(["error" => "not_logged_in"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
$recipeId = (int)($data["recipe_id"] ?? 0);

if ($recipeId <= 0) {
    http_response_code(400);
    exit;
}

/* ellenőrizni hogy már likeolta-e */
$stmt = mysqli_prepare($conn, "SELECT id FROM recipe_likes WHERE user_id = ? AND recipe_id = ?");
mysqli_stmt_bind_param($stmt, "ii", $userId, $recipeId);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

if (mysqli_fetch_assoc($res)) {

    /* unlike */
    $stmt = mysqli_prepare($conn, "DELETE FROM recipe_likes WHERE user_id = ? AND recipe_id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $userId, $recipeId);
    mysqli_stmt_execute($stmt);

    echo json_encode(["status" => "unliked"]);

} else {

    /* like */
    $stmt = mysqli_prepare($conn, "INSERT INTO recipe_likes (user_id, recipe_id) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ii", $userId, $recipeId);
    mysqli_stmt_execute($stmt);

    echo json_encode(["status" => "liked"]);

}