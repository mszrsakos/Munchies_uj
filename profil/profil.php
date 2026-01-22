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
    <title>Profil</title>
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

</head>
<body>
    <div id="teljes_oldal">
        
        <?php include("../header/header.html");?>
        

        <!-- Szemelyes adatok kezdete -->
         <div class="szemelyes_adatok">
            <div>
                <img class="profil_kep" src="../imgs/profil_kep-removebg-preview.png" alt="profilkep">
            </div>
            <div class="adatok">
                <h1 class="nev">Varga Krisztina</h1>
                <br>

                <div class="valami">
                <h2>Kedvencek</h2>
                <h2>Feltöltött receptjeim</h2>
                </div>

                
            </div>
            
         </div>
         <!-- Szemelyes adatok vege -->

         <!-- Tartalom kezdete -->
         <div class="tartalom">
            <div>
                <button class="button1">Személyes adatok módosítása</button>
                <button class="button2">Változtatások mentése</button>
                <button class="button2"><a href="../kijelentkezes.php">Kijelentkezés</a></button>
            </div>

            <div class="valtoztatasok">
                <div>
                    <h1>Profilkép</h1>
                    <button class="profilkep_gomb">+</button>
                </div>
                <div>
                    <h1>Név</h1>
                    <input type="text" class="nev_input">
                </div>
            
            </div>
        </div>


         <!-- Tartalom vege -->

        <!-- Rolam rész kezdete -->
         <div class="rolam">
                <h1>Rólam</h1>
                <input type="text" class="rolam_input">
        </div>
        <!-- Rólam rész vége -->
    </div>
    
    <?php include("../footer/footer.html"); ?>   

    <script src="profil.js"></script>
</body>
</html>