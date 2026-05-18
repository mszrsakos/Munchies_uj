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
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $_SESSION["email"]);
    $stmt->execute();
    $stmt->bind_result($uid);
    $stmt->fetch();
    $_SESSION["user_id"] = $uid;
    $stmt->close();
}

$user_id = (int)$_SESSION["user_id"];

function h($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8");
}

/* =====================
   MENU LOAD
===================== */

$menu = [];

$stmt = $conn->prepare("
    SELECT mp.day, mp.meal, r.id AS recipe_id, r.title, r.image_url
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
   SEARCH
===================== */

$q = trim($_GET["q"] ?? "");

if ($q !== "") {
    $stmt = $conn->prepare("
        SELECT id, title, image_url 
        FROM recipes 
        WHERE title LIKE ? 
        ORDER BY created_at DESC
    ");
    $like = "%".$q."%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("
        SELECT id, title, image_url 
        FROM recipes 
        ORDER BY created_at DESC
    ");
}

/* =====================
   SAVED
===================== */

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
   AJAX
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
    <link rel="stylesheet" href="menutervezo1.css">
    <link rel="stylesheet" href="../header/header.css">
</head>

<body>

<?php include("../header/header.html"); ?>

<main>

<div class="table-wrapper">

        <div class="day-selector"> 
            <select id="daySelect"> 
                <?php foreach ($days as $index => $day): ?> 
                    <option value="<?= h($day) ?>"> <?= h($day) ?> 
                </option> 
                <?php endforeach; ?> 
            </select> 
        </div>
    <!-- =====================
         DESKTOP GRID (DAY × MEAL)
    ====================== -->
    <div class="grid-table desktop-grid">

        <div id="sarokText">Menütervező</div>

        <?php foreach ($meals as $meal): ?>
            <div class="grid-header"><?= h($meal) ?></div>
        <?php endforeach; ?>

        <?php foreach ($days as $day): ?>

            <div class="grid-header"><?= h($day) ?></div>

            <?php foreach ($meals as $meal): ?>
                <div class="cell"
                    data-day="<?= h($day) ?>"
                    data-meal="<?= h($meal) ?>">

                    <?php if (isset($menu[$day][$meal])): ?>
                        <div class="menu-img-wrapper"
                            data-day="<?= h($day) ?>"
                            data-meal="<?= h($meal) ?>">

                            <img
                                src="../imgs/<?= h($menu[$day][$meal]["image_url"]) ?>"
                                class="menu-img"
                                alt="<?= h($menu[$day][$meal]["title"]) ?>"
                            >

                            <button class="remove-btn">✕</button>

                            <a class="open-recipe-btn"
                            href="../recept_sema/recept.php?id=<?= (int)$menu[$day][$meal]["recipe_id"] ?>">
                                ↗
                            </a>
                        </div>
                    <?php else: ?>
                        <button class="add-btn add-recipe"
                                data-day="<?= h($day) ?>"
                                data-meal="<?= h($meal) ?>">
                            +
                        </button>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

        <?php endforeach; ?>

    </div>


    <!-- =====================
        MOBILE GRID
    ===================== -->
    <div class="grid-table mobile-grid">

        <div id="sarokText">Menütervező</div>

        <?php foreach ($meals as $meal): ?>

            <div class="grid-header"><?= h($meal) ?></div>

            <div class="cell mobile-row">

                <?php foreach ($days as $day): ?>

                    <div class="day-slot cell"
                        data-day="<?= h($day) ?>"
                        data-meal="<?= h($meal) ?>">

                        <?php if (isset($menu[$day][$meal])): ?>

                            <div class="menu-img-wrapper"
                                data-day="<?= h($day) ?>"
                                data-meal="<?= h($meal) ?>">

                                <img
                                    src="../imgs/<?= h($menu[$day][$meal]["image_url"]) ?>"
                                    class="menu-img"
                                    alt="<?= h($menu[$day][$meal]["title"]) ?>"
                                >

                                <button class="remove-btn">✕</button>

                                <a class="open-recipe-btn"
                                href="../recept_sema/recept.php?id=<?= (int)$menu[$day][$meal]["recipe_id"] ?>">
                                    ↗
                                </a>
                            </div>

                        <?php else: ?>

                            <button class="add-btn add-recipe"
                                    data-day="<?= h($day) ?>"
                                    data-meal="<?= h($meal) ?>">
                                +
                            </button>

                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endforeach; ?>

    </div>



</div>

</div>

</main>

<!-- =====================
     OVERLAY (marad ugyanaz)
===================== -->
<div id="etelOverlay">
    <div id="etelValasztas">

        <div id="etelValasztasTop">
            <p id="valasztottEtkezesText"></p>

            <div class="searchbarDiv">
                <form id="searchForm" class="search-bar" autocomplete="off">
                    <input type="text" id="searchInput" name="q" placeholder="Keresés receptre..." />
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
</div>

<?php include("../footer/footer.html"); ?>

<script src="menutervezo1.js"></script>
</body>
</html>