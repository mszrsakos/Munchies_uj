<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../bejelentkezes/bejelentkezes.php");
    exit();
}

require_once "../database.php";

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"] ?? "");
    $time = $_POST["prepTime"] ?? null;
    $cost = $_POST["cost"] ?? "";
    $difficulty = $_POST["difficulty"] ?? "";

    $ingredients = json_decode($_POST["ingredients"] ?? "[]", true);
    $steps = json_decode($_POST["steps"] ?? "[]", true);

    if (empty($title)) $errors[] = "Hiányzik a recept neve!";
    if (empty($time)) $errors[] = "Add meg az időt!";
    if (empty($cost)) $errors[] = "Válassz költséget!";
    if (empty($difficulty)) $errors[] = "Válassz nehézséget!";
    if (empty($ingredients)) $errors[] = "Adj meg alapanyagokat!";
    if (empty($steps)) $errors[] = "Adj meg lépéseket!";

    $imagePath = null;

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $targetDir = "../imgs/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = uniqid() . "_" . $_FILES['image']['name'];
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $fileName;
        } else {
            $errors[] = "Kép feltöltési hiba!";
        }
    } else {
        $errors[] = "Kérlek, válassz egy képet a recepthez!";
    }

    if (empty($errors)) {

        $user_id = $_SESSION["user_id"];

        $stmt = $conn->prepare("INSERT INTO recipes (title, image_url, time_minutes, cost, difficulty, created_by) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissi", $title, $imagePath, $time, $cost, $difficulty, $user_id);
        $stmt->execute();

        $recipe_id = $stmt->insert_id;

        $stmtIng = $conn->prepare("INSERT INTO recipe_ingredients (recipe_id, amount, unit, name) VALUES (?, ?, ?, ?)");
        foreach ($ingredients as $ing) {
            $amount = $ing['amount'] ?? null;
            $unit = $ing['unit'] ?? null;
            $name = $ing['name'] ?? null;

            $stmtIng->bind_param("isss", $recipe_id, $amount, $unit, $name);
            $stmtIng->execute();
        }

        $stmtStep = $conn->prepare("INSERT INTO recipe_steps (recipe_id, step_no, step_text) VALUES (?, ?, ?)");
        $step_no = 1;
        foreach ($steps as $step) {
            $stmtStep->bind_param("iis", $recipe_id, $step_no, $step);
            $stmtStep->execute();
            $step_no++;
        }

        $success = "Sikeres feltöltés!";
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recept feltöltés</title>
    <link rel="stylesheet" href="feltoltes1.css">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>

<body>

<form method="POST" enctype="multipart/form-data">

<?php include("../header/Header.html");?>

<div class="cim">
    <h1>Saját recept feltöltése</h1>

    <?php
    if (!empty($errors)) {
        foreach ($errors as $e) {
            echo "<p style='color:red;'>$e</p>";
        }
    }
    if ($success) {
        echo "<p style='color:green;'>$success</p>";
    }
    ?>
</div>

<div class="kep_hozzaadas">
    <h1 id="receptImg">Recept képe</h1>

    <div class="upload-area" id="uploadArea">
        <input type="file" name="image" id="imageInput" accept="image/*" hidden>

        <div class="upload-content" id="uploadContent">
            <div class="upload-icon">📷</div>
            <p>Kattints vagy húzd ide a képet</p>
        </div>
    </div>
</div>

<div class="tartalom">

<div class="card">
<h2>Új recept</h2>

<input class="recipe-input" name="title" placeholder="Recept neve">

<h3>Kategória:</h3>

<div class="tags">
    <label class="tag"><input type="checkbox"><span>Leves</span></label>
    <label class="tag"><input type="checkbox"><span>Előétel</span></label>
    <label class="tag"><input type="checkbox"><span>Főétel</span></label>
    <label class="tag"><input type="checkbox"><span>Desszert</span></label>
    <label class="tag"><input type="checkbox"><span>Reggeli</span></label>
    <label class="tag"><input type="checkbox"><span>Sütemény</span></label>
</div>

<div class="extra-fields">

<div class="field">
    <label>Elkészítési idő (perc):</label>
    <input type="number" name="prepTime" id="prepTime">
</div>

<div class="field">
    <label>Költség:</label>
        <select name="cost" id="cost">
        <option value="">Válassz...</option>
        <option value="olcsó">Olcsó</option>
        <option value="megfizethető">Megfizethető</option>
        <option value="drága">Drága</option>
    </select>
</div>

<div class="field">
    <label>Nehézség:</label>
    <select name="difficulty" id="difficulty">
        <option value="">Válassz...</option>
        <option value="könnyű">Könnyű</option>
        <option value="közepes">Közepes</option>
        <option value="nehéz">Nehéz</option>
    </select>
</div>

</div>
</div>

<div class="card">
<h2>Alapanyagok feltöltése</h2>

<div class="step-box">
    <input type="text" id="quantityInput" placeholder="Mennyiség">
    <input type="text" id="measureInput" placeholder="Mértékegység">
    <input type="text" id="ingredientInput" placeholder="Alapanyag">
    <button type="button" onclick="addIngredient()">+</button>
</div>

<h3>Alapanyagok:</h3>
<ul id="ingredientList"></ul>
</div>

</div>

<div class="step-container">

    <p class="section-title">Elkészítés lépései</p>

    <div class="step-box">
        <input type="text" id="stepInput" placeholder="Írd be a lépést...">
        <button type="button" onclick="addStep()">+</button>
    </div>

    <ol id="stepList" class="step-list"></ol>

</div>

<input type="hidden" name="ingredients" id="ingredientsHidden">
<input type="hidden" name="steps" id="stepsHidden">

<div id="submitArea">
    <button type="submit" class="submit-button">Recept feltöltése</button>
</div>

</form>
<?php include("../footer/footer.html");?>



<script src="app.js"></script>

<script>
document.querySelector(".submit-button").addEventListener("click", function() {

    const ingredients = [];
    document.querySelectorAll("#ingredientList li").forEach(li => {
        ingredients.push(li.textContent);
    });

    const steps = [];
    document.querySelectorAll("#stepList li").forEach(li => {
        steps.push(li.textContent);
    });

    document.getElementById("ingredientsHidden").value = JSON.stringify(ingredients);
    document.getElementById("stepsHidden").value = JSON.stringify(steps);
});





function addIngredient() {
    const quantityInput = document.getElementById("quantityInput");
    const measureInput = document.getElementById("measureInput");
    const ingredientInput = document.getElementById("ingredientInput");
    const list = document.getElementById("ingredientList");

    if (quantityInput.value.trim() !== "" && ingredientInput.value.trim() !== "") {
        const li = document.createElement("li");
        li.textContent = `${quantityInput.value} ${measureInput.value} ${ingredientInput.value}`;
        li.dataset.amount = quantityInput.value;
        li.dataset.unit = measureInput.value;
        li.dataset.name = ingredientInput.value;

        let deleteBtn = document.createElement("button");
        deleteBtn.classList.add("deleteBtn");
        deleteBtn.textContent = "✖";

        deleteBtn.addEventListener("click", function() {
            li.remove();
        });

        li.appendChild(deleteBtn);

        list.appendChild(li);

        // Clear inputs
        quantityInput.value = "";
        measureInput.value = "";
        ingredientInput.value = "";
    }
}

function addStep() {
    const input = document.getElementById("stepInput");
    const list = document.getElementById("stepList");

    if (input.value.trim() !== "") {
        const li = document.createElement("li");
        li.textContent = input.value;
        list.appendChild(li);
        input.value = "";
    }
}

document.querySelector(".submit-button").addEventListener("click", function () {
    const ingredients = [];
    document.querySelectorAll("#ingredientList li").forEach(li => {
        ingredients.push({
            amount: li.dataset.amount,
            unit: li.dataset.unit,
            name: li.dataset.name
        });
    });

    const steps = [];
    document.querySelectorAll("#stepList li").forEach(li => {
        steps.push(li.textContent);
    });

    document.getElementById("ingredientsHidden").value = JSON.stringify(ingredients);
    document.getElementById("stepsHidden").value = JSON.stringify(steps);
});

</script>

</body>
</html>