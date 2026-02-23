<?php
session_start();
require_once "../database.php";

/* =========================
   AUTH CHECK
========================= */
if (!isset($_SESSION["user_id"])) {
    http_response_code(401);
    echo json_encode([
        "success" => false,
        "error" => "Not authenticated"
    ]);
    exit;
}

$user_id = (int)$_SESSION["user_id"];

/* =========================
   READ JSON INPUT
========================= */
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!$data) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "error" => "Invalid JSON"
    ]);
    exit;
}

$day       = $data["day"]  ?? null;
$meal      = $data["meal"] ?? null;
$recipe_id = isset($data["recipe_id"]) ? (int)$data["recipe_id"] : 0;

/* =========================
   VALIDATION
========================= */
$valid_days = ['Hétfő','Kedd','Szerda','Csütörtök','Péntek','Szombat','Vasárnap'];
$valid_meals = ['Reggeli','Ebéd','Vacsora','Egyéb'];

if (
    !$day || !$meal || !$recipe_id ||
    !in_array($day, $valid_days, true) ||
    !in_array($meal, $valid_meals, true)
) {
    http_response_code(422);
    echo json_encode([
        "success" => false,
        "error" => "Invalid input data"
    ]);
    exit;
}

/* =========================
   SAVE TO DATABASE
========================= */
$stmt = $conn->prepare("
    INSERT INTO menu_plan (user_id, day, meal, recipe_id)
    VALUES (?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE recipe_id = VALUES(recipe_id)
");

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => "Prepare failed"
    ]);
    exit;
}

$stmt->bind_param("issi", $user_id, $day, $meal, $recipe_id);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => "Database error"
    ]);
    exit;
}

$stmt->close();

/* =========================
   SUCCESS RESPONSE
========================= */
echo json_encode([
    "success"   => true,
    "user_id"   => $user_id,
    "day"       => $day,
    "meal"      => $meal,
    "recipe_id" => $recipe_id
]);