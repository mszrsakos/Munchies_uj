<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feltoltes</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
<?php include("../header/Header.html");?>
<div class="tartalom">

    <div class="cim">
        <h1>Saját recept feltöltése</h1>
    </div>
    <h1>Recept alapadatok</h1>

    <div class="recept_alapadatok" >

        <div class="recept_neve" >
        <label for="recept_neve">Recept neve:</label>
        <input type="text" id="recept_neve" name="recept_neve" placeholder="Írd be a recept nevét">
        </div>

        <div class="category-box">
  <p class="label">Kategória</p>

  <label>
    <input type="checkbox" name="category[]" value="leves">
    Leves
  </label>

  <label>
    <input type="checkbox" name="category[]" value="foetel">
    Főétel
  </label>

  <label>
    <input type="checkbox" name="category[]" value="desszert">
    Desszert
  </label>

  <label>
    <input type="checkbox" name="category[]" value="vegetarianus">
    Vegetáriánus
  </label>

  <label>
    <input type="checkbox" name="category[]" value="vegan">
    Vegán
  </label>

  <label>
    <input type="checkbox" name="category[]" value="gyors">
    Gyors recept
  </label>
</div>
        
    </div>




















</div>

<script src="feltoltes.js"></script>
</body>
</html>