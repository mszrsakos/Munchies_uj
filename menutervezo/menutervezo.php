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
    <link rel="stylesheet" href="menutervezo.css">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

</head>
<body>

    <?php include("../header/header.html");?>

    <main>
        <div id="tableContainer"></div>
        <div id="navigation">
            <button id="prevWeek">Előző hét</button>
            <button id="nextWeek">Következő hét</button>
        </div>
    </main>
    <script src="menutervezo.js"></script>
    <!-- <main class="tablazat">
        <div class="cell"></div>
        <div class="cell">Reggeli</div>
        <div class="cell">Ebéd</div>
        <div class="cell">Vacsora</div>
        <div class="cell">Egyéb</div>

        <div class="cell">Hétfő</div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>

        <div class="cell">Kedd</div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>

        <div class="cell">Szerda</div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>

        <div class="cell">Csütörtök</div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>

        <div class="cell">Péntek</div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>

        <div class="cell">Szombat</div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>

        <div class="cell">Vasárnap</div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
        <div class="cell"><button>+</button></div>
    </main> -->
    
    <?php include("../footer/footer.html"); ?>

</body>
    
</html>