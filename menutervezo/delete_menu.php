<?php
session_start();
require_once "../database.php";

if (!isset($_SESSION["user_id"])) {
    echo json_encode(["success" => false]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$day = $data["day"] ?? null;
$meal = $data["meal"] ?? null;

if (!$day || !$meal) {
    echo json_encode(["success" => false]);
    exit;
}

$stmt = $conn->prepare("
    DELETE FROM menu_plan
    WHERE user_id = ? AND day = ? AND meal = ?
");

$stmt->bind_param("iss", $_SESSION["user_id"], $day, $meal);
$stmt->execute();
$stmt->close();

echo json_encode(["success" => true]);
?>