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

    <div class="kep_hozzaadas">
    <h1 class="section-title" >Recept képe</h1>

<div class="upload-area" id="uploadArea">
    <input type="file" id="imageInput" accept="image/*" hidden>
    
    <div class="upload-content" onclick="document.getElementById('imageInput').click()">
        <div class="upload-icon">📷</div>
        <p>Kattints vagy húzd ide a képet</p>
    </div>

    <img id="previewImage" class="preview" />
</div>

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

<label class="tag">
<input type="checkbox">
<span>Reggeli</span>
</label>

<label class="tag">
<input type="checkbox">
<span>Sütemény</span>
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

<!-- Elkeszetes lepesei kezdete -->
<div class="step-container">


<p class="section-title">Elkészítés lépései</p>

<div class="step-box">
    <input type="text" id="stepInput" placeholder="Írd be a lépést...">
    <button onclick="addStep()">+</button>
</div>

<ol id="stepList" class="step-list"></ol>

<script>
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
</script>
</div>

<div class="hozzaad_gomb">
    <button class="submit-button">Recept feltöltése</button>

</div>
<!-- Elkeszites lepesei vege  -->


<script src="feltoltes.js"></script>
</body>
</html>