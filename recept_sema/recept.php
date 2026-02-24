<?php
session_start();
$loggedInUserId = (int)($_SESSION["user_id"] ?? 0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

require_once "../database.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) { http_response_code(400); die("Hibás recept id."); }

/* ===== Recept + beküldő betöltése (users.display) ===== */
$sql = "
  SELECT 
    r.*,
    u.id AS creator_id,
    u.display AS creator_name,
    u.profile_image_url AS creator_image
  FROM recipes r
  LEFT JOIN users u ON u.id = r.created_by
  WHERE r.id = ?
  LIMIT 1
";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) { die("Prepare hiba: " . mysqli_error($conn)); }

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$recipe = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$recipe) { http_response_code(404); die("Nincs ilyen recept."); }

/* ===== Hozzávalók betöltése ===== */
$stmt = mysqli_prepare($conn, "SELECT amount, unit, name FROM recipe_ingredients WHERE recipe_id = ? ORDER BY id ASC");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

$ingredients = [];
while ($row = mysqli_fetch_assoc($res)) {
  $row["amount"] = $row["amount"] !== null ? (float)$row["amount"] : null;
  $ingredients[] = $row;
}
mysqli_stmt_close($stmt);

/* ===== Elkészítés lépések betöltése ===== */
$steps = [];
$stmt = mysqli_prepare($conn, "SELECT step_no, step_text FROM recipe_steps WHERE recipe_id = ? ORDER BY step_no ASC");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($res)) {
  $steps[] = $row;
}
mysqli_stmt_close($stmt);

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }

/* ===== Oldal változók ===== */
$title = $recipe["title"] ?? "Recept";

/* Kép: DB-ben fájlnév van -> ../imgs/fajlnev */
$imageFile = trim((string)($recipe["image_url"] ?? ""));
$image = $imageFile !== "" ? "../imgs/" . ltrim($imageFile, "/") : "";

$baseServings = (int)($recipe["base_servings"] ?? 1);

$time = !empty($recipe["time_minutes"]) ? ((int)$recipe["time_minutes"] . "p") : "—";
$cost = !empty($recipe["cost"]) ? $recipe["cost"] : "—";
$difficulty = !empty($recipe["difficulty"]) ? $recipe["difficulty"] : "—";

/* Beküldő (display) */
$creator = trim((string)($recipe["creator_name"] ?? ""));
$creatorLabel = $creator !== "" ? $creator : "ismeretlen";
$creatorId = (int)($recipe["creator_id"] ?? 0);

if ($creatorId > 0) {
  if ($loggedInUserId === $creatorId) {
    $profileLink = "../profil/profil.php";
  } else {
    $profileLink = "../masFelhasznalo/masFelhasznalo.php?id=" . $creatorId;
  }
} else {
  $profileLink = null;
}

// $isOwnProfile = isset($_SESSION["email"]) && $_SESSION["email"] === $recipe["created_by_email"];
// $profileLink = $isOwnProfile ? "../profil/profil.php" : "../masFelhasznalo/masFelhasznalo.php?id=" . (int)$recipe["created_by"];
// /* Ellenőrizd, hogy a bejelentkezett felhasználó azonos-e a beküldővel */
// $isOwnProfile = isset($_SESSION["user_id"]) && $_SESSION["user_id"] === (int)$recipe["created_by"];
// $profileLink = $isOwnProfile 
//     ? "../profil/profil.php" 
//     : "../masFelhasznalo/masFelhasznalo.php?id=" . (int)$recipe["created_by"];
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= h($title) ?></title>

  <link rel="stylesheet" href="../recept_sema/recept.css">
  <link rel="stylesheet" href="../header/header.css">
  <link rel="stylesheet" href="../footer/footer.css">
  <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>

<?php include("../header/header.html"); ?>

<div class="teljes_oldal">
  <div class="container">

    <div class="left">
      <h1><?= h($title) ?></h1>

      <!-- Beküldő -->
      <p style="margin: 6px 0 14px 0; opacity: .8;">
      <?php if ($profileLink): ?>
        Beküldte: <a href="<?= h($profileLink) ?>"><strong><?= h($creatorLabel) ?></strong></a>
      <?php else: ?>
        Beküldte: <strong>ismeretlen</strong>
      <?php endif; ?>
      
      </p>
      

      <?php if ($image): ?>
        <img class="kep" src="<?= h($image) ?>" alt="<?= h($title) ?>">
      <?php endif; ?>

      <div class="valami">
        <table class="tapanyag_kaloria">
          <tr>
            <th>IDŐ</th>
            <th>KÖLTSÉG</th>
            <th style="border: 0px;">NEHÉZSÉG</th>
          </tr>
          <tr>
            <td><?= h($time) ?></td>
            <td><?= h($cost) ?></td>
            <td style="border: 0px;"><?= h($difficulty) ?></td>
          </tr>
        </table>
      </div>

      <div class="hozzavalok">
        <h1>Hozzávalók</h1>

        <div class="counter">
          <p>Adagok száma</p>
          <div class="counter2">
            <button type="button" onclick="decrease()">−</button>
            <span id="count"><?= (int)$baseServings ?></span>
            <button type="button" onclick="increase()">+</button>
          </div>
        </div>

        <!-- recept.js tölti fel -->
        <ul></ul>
      </div>
    </div>

    <div class="right">
      <h1>Elkészítés</h1>

      <ol>
        <?php if (count($steps) > 0): ?>
          <?php foreach ($steps as $s): ?>
            <?php
              $text = trim((string)($s["step_text"] ?? ""));
              $isHeading = false;
              $clean = $text;

              // ## Alcím
              if (str_starts_with($clean, "##")) {
                $isHeading = true;
                $clean = trim(substr($clean, 2));
              }
              // -- Alcím --
              else if (str_starts_with($clean, "--") && str_ends_with($clean, "--")) {
                $isHeading = true;
                $clean = trim($clean, "- ");
              }
            ?>

            <?php if ($isHeading): ?>
              <li><strong><?= h($clean) ?></strong></li>
            <?php else: ?>
              <li><?= h($text) ?></li>
            <?php endif; ?>

          <?php endforeach; ?>
        <?php else: ?>
          <li>—</li>
        <?php endif; ?>
      </ol>
    </div>

  </div>

  <div class="spacer2"></div>
</div>

<div class="spacer"></div>

<?php include("../footer/footer.html"); ?>

<script>
  window.RECIPE_BASE_SERVINGS = <?= (int)$baseServings ?>;
  window.RECIPE_INGREDIENTS = <?= json_encode($ingredients, JSON_UNESCAPED_UNICODE) ?>;
</script>
<script src="../recept_sema/recept.js"></script>

</body>
</html>
