<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: ../bejelentkezes/bejelentkezes.php");
    exit();
}

require_once "../database.php";

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
    <link rel="stylesheet" href="menutervezo1.css">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
</head>

<body>

<?php include("../header/header.html");?>

<main>
    <div class="grid-table">
        <div></div>
        <div class="grid-header">Reggeli</div>
        <div class="grid-header">Ebéd</div>
        <div class="grid-header">Vacsora</div>
        <div class="grid-header">Egyéb</div>

        <div class="grid-header">Hétfő</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
        <div class="grid-header">Kedd</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
        <div class="grid-header">Szerda</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
        <div class="grid-header">Csütörtök</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
        <div class="grid-header">Péntek</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
        <div class="grid-header">Szombat</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
        <div class="grid-header">Vasárnap</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
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
