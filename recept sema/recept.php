<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once "../database.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) { http_response_code(400); die("Hibás recept id."); }

// Load recipe
$stmt = mysqli_prepare($conn, "SELECT * FROM recipes WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$recipe = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$recipe) { http_response_code(404); die("Nincs ilyen recept."); }

// Load ingredients
$stmt = mysqli_prepare($conn, "SELECT amount, unit, name FROM recipe_ingredients WHERE recipe_id = ? ORDER BY id ASC");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

$ingredients = [];
while ($row = mysqli_fetch_assoc($res)) {
  // amount can be NULL
  $row["amount"] = $row["amount"] !== null ? (float)$row["amount"] : null;
  $ingredients[] = $row;
}
mysqli_stmt_close($stmt);

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }

$title = $recipe["title"] ?? "Recept";
$image = $recipe["image_url"] ?? "";
$baseServings = (int)($recipe["base_servings"] ?? 1);

// These 3 are optional columns you added:
$time = isset($recipe["time_minutes"]) && $recipe["time_minutes"] ? ((int)$recipe["time_minutes"] . "p") : "—";
$cost = !empty($recipe["cost"]) ? $recipe["cost"] : "—";
$difficulty = !empty($recipe["difficulty"]) ? $recipe["difficulty"] : "—";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= h($title) ?></title>

  <!-- Use your TomYum styling as the general recipe style -->
  <link rel="stylesheet" href="../recept sema/recept.css">
  <link rel="stylesheet" href="../header/header.css">
  <link rel="stylesheet" href="../footer/receptfooter.css">


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>

<?php include("../header/receptHeader.html"); ?>

<div class="teljes_oldal">
  <div class="container">
    <div class="left">
      <h1><?= h($title) ?></h1>

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
            <span id="count"><?= $baseServings ?></span>
            <button type="button" onclick="increase()">+</button>
          </div>
        </div>

        <ul></ul>
      </div>
    </div>

    <div class="right">
      <h1>Elkészítés</h1>

      <?php
        // If you stored instructions with newlines, convert them to <li> items nicely:
        $stepsRaw = $recipe["instructions"] ?? "";
        $steps = array_values(array_filter(array_map("trim", preg_split("/\\r\\n|\\r|\\n/", $stepsRaw))));
      ?>

      <ol>
        <?php if (count($steps) > 0): ?>
          <?php foreach ($steps as $s): ?>
            <li><?= h($s) ?></li>
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

<?php include("../footer/receptfooter.html"); ?>

<script>
  // Pass DB data to JS for serving-scaling:
  window.RECIPE_BASE_SERVINGS = <?= (int)$baseServings ?>;
  window.RECIPE_INGREDIENTS = <?= json_encode($ingredients, JSON_UNESCAPED_UNICODE) ?>;
</script>
<script src="../recept sema/recept.js"></script>


</body>
</html>
