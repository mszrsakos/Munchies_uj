<?php 
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../bejelentkezes/bejelentkezes.php");
    exit();
}

require_once "../database.php";

$days = ["Hétfő", "Kedd", "Szerda", "Csütörtök", "Péntek", "Szombat", "Vasárnap"];
$meals = ["Reggeli", "Ebéd", "Vacsora", "Egyéb"];

if (!isset($_SESSION["user_id"])) {
    // fallback if you only stored email before
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $_SESSION["email"]);
    $stmt->execute();
    $stmt->bind_result($uid);
    $stmt->fetch();
    $_SESSION["user_id"] = $uid;
    $stmt->close();
}

$menu = [];

$stmt = $conn->prepare("
    SELECT 
        mp.day,
        mp.meal,
        r.id AS recipe_id,
        r.title,
        r.image_url
    FROM menu_plan mp
    JOIN recipes r ON r.id = mp.recipe_id
    WHERE mp.user_id = ?
");

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $menu[$row["day"]][$row["meal"]] = $row;
}

$stmt->close();

/* =====================
   SEARCH LOGIC
===================== */

$q = trim($_GET["q"] ?? "");

if ($q !== "") {
    $stmt = mysqli_prepare(
        $conn,
        "SELECT id, title, image_url 
         FROM recipes 
         WHERE title LIKE ? 
         ORDER BY created_at DESC"
    );
    $like = "%".$q."%";
    mysqli_stmt_bind_param($stmt, "s", $like);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $result = mysqli_query(
        $conn,
        "SELECT id, title, image_url 
         FROM recipes 
         ORDER BY created_at DESC"
    );
}

function h($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8");
}

$saved = [];
$stmt = $conn->prepare("
    SELECT day, meal, recipe_id
    FROM menu_plan
    WHERE user_id = ?
");
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$res = $stmt->get_result();

while ($row = $res->fetch_assoc()) {
    $saved[$row["day"]][$row["meal"]] = $row["recipe_id"];
}
$stmt->close();

/* =====================
   AJAX RESPONSE ONLY
===================== */
if (isset($_GET["ajax"]) && $_GET["ajax"] === "1") {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="img-wrapper">
            <a class="kepLink" href="../recept_sema/recept.php?id=<?= (int)$row["id"] ?>">
                <img class="kep" src="../imgs/<?= h($row["image_url"]) ?>" alt="">
                <div class="content fade"><?= h($row["title"]) ?></div>
            </a>
        </div>
        <?php
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menütervező</title>

    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="menutervezo.css">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
</head>

<body>

<?php include("../header/header.html");?>

<main>
    <div class="grid-table">

    <!-- Top-left empty corner -->
    <div></div>

    <!-- Meal headers -->
    <?php foreach ($meals as $meal): ?>
        <div class="grid-header"><?= h($meal) ?></div>
    <?php endforeach; ?>

    <!-- Rows -->
    <?php foreach ($days as $day): ?>

        <!-- Day header -->
        <div class="grid-header"><?= h($day) ?></div>

        <!-- Cells -->
        <?php foreach ($meals as $meal): ?>
            <div class="cell" data-day="<?= h($day) ?>" data-meal="<?= h($meal) ?>">

                <?php if (isset($menu[$day][$meal])): ?>
                    <img
                        src="../imgs/<?= h($menu[$day][$meal]["image_url"]) ?>"
                        class="menu-img"
                        alt="<?= h($menu[$day][$meal]["title"]) ?>"
                    >
                <?php else: ?>
                    <button class="add-btn">+</button>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>

    <?php endforeach; ?>

</div>
</main>

<div id="etelValasztas">
    <div id="etelValasztasTop">
        <p id="valasztottEtkezesText"></p>

        <div class="searchbarDiv">
            <form id="searchForm" class="search-bar" autocomplete="off">
                <input type="text"
                       id="searchInput"
                       name="q"
                       placeholder="Keresés receptre..." />
                <button type="submit">
                    <img src="../imgs/keresesbtn-removebg-preview.png">
                </button>
            </form>
        </div>
    </div>

    <div id="etelValasztasBottom">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="img-wrapper">
                <a class="kepLink" href="../recept_sema/recept.php?id=<?= (int)$row["id"] ?>">
                    <img class="kep" src="../imgs/<?= h($row["image_url"]) ?>" alt="">
                    <div class="content fade"><?= h($row["title"]) ?></div>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include("../footer/footer.html");?>

<script src="menutervezo.js"></script>
</body>
</html>
