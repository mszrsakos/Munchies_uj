<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Munchies</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>

    
    <nav><h1 id="navTxt">Munchies</h1></nav>
    <div id="oldalak">
        <a href="../receptek/receptek.php"><div><button id="receptek">Receptek</button></div></a>
        <div><button id="menutervezo">Menütervező</button></div>
    </div>

    <?php include("../footer/footer.html"); ?>

    <script src="main.js"></script>
</body>
</html>

