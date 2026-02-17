<?php 
    session_start();
    if (!isset($_SESSION["email"])) {
        header("Location: ../bejelentkezes/bejelentkezes.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menütervező</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="menutervezo.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

</head>
<body>

    <?php include("../header/header.html");?>
    <main>
        <div class="grid-table">
            <!-- Headers -->
            <div></div>
            <div class="grid-header">Reggeli</div>
            <div class="grid-header">Ebéd</div>
            <div class="grid-header">Vacsora</div>
            <div class="grid-header">Egyéb</div>

            <!-- Row 1 -->
            <div class="grid-header">R1 C1</div><div>R1 C2</div><div>R1 C3</div><div>R1 C4</div><div>R1 C5</div>
            <!-- Row 2 -->
            <div class="grid-header">R2 C1</div><div>R2 C2</div><div>R2 C3</div><div>R2 C4</div><div>R2 C5</div>
            <!-- Row 3 -->
            <div class="grid-header">R3 C1</div><div>R3 C2</div><div>R3 C3</div><div>R3 C4</div><div>R3 C5</div>
            <!-- Row 4 -->
            <div class="grid-header">R4 C1</div><div>R4 C2</div><div>R4 C3</div><div>R4 C4</div><div>R4 C5</div>
            <!-- Row 5 -->
            <div class="grid-header">R5 C1</div><div>R5 C2</div><div>R5 C3</div><div>R5 C4</div><div>R5 C5</div>
        </div>
    </main>


    <?php include("../footer/footer.html"); ?>

</body>
    
</html>