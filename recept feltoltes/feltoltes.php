<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feltoltes</title>
    <link rel="stylesheet" href="feltoltes.css">
    <link rel="stylesheet" href="../header/header.css">
    <!-- <link rel="stylesheet" href="../footer/footer.css"> -->
    <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    
</head>
<body>
<?php include("../header/Header.html");?>
<div class="cim">
        <h1>Saját recept feltöltése</h1>
    </div>
<div class="tartalom">

    

<!-- UJ RECEPT KARTYA KEZDETE -->
<div class="card">

<h2>Új recept</h2>

<input class="recipe-input" placeholder="Recept neve">

<p>Kategória:</p>

<div class="tags">

<label class="tag">
<input type="checkbox">
<span>Leves</span>
</label>

<label class="tag">
<input type="checkbox">
<span>Előétel</span>
</label>

<label class="tag">
<input type="checkbox">
<span>Főétel</span>
</label>

<label class="tag">
<input type="checkbox">
<span>Desszert</span>
</label>

<label class="tag">
<input type="checkbox">
<span>Ital</span>
</label>

</div>

</div>
<!-- UJ RECEPT KARTYA VEGE -->


<!-- ALAPANYAGOK FELTOLTESE KEZDETE -->
<div class="container">
    <h2>Alapanyagok feltöltése</h2>

    <input type="text" id="ingredientInput" placeholder="Írd be az alapanyagot">
    <button onclick="addIngredient()">Hozzáadás</button>

    <h3>Alapanyagok:</h3>
    <ul id="ingredientList"></ul>
</div>

<script>
function addIngredient() {
    const input = document.getElementById("ingredientInput");
    const list = document.getElementById("ingredientList");

    if (input.value.trim() !== "") {
        const li = document.createElement("li");
        li.textContent = input.value;
        list.appendChild(li);
        input.value = "";
    }
}
</script>
<!-- ALAPANYAGOK FELTOLTESE VEGE -->
















</div>

<script src="feltoltes.js"></script>
</body>
</html>