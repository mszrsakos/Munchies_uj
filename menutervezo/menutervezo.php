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
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="menutervezo1.css">
    
    <link rel="stylesheet" href="../header/header.css">
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
            <div class="grid-header">Hétfő</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
            <!-- Row 2 -->
            <div class="grid-header">Kedd</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
            <!-- Row 3 -->
            <div class="grid-header">Szerda</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
            <!-- Row 4 -->
            <div class="grid-header">Csütörtök</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
            <!-- Row 5 -->
            <div class="grid-header">Péntek</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
            <!-- Row 6 -->
            <div class="grid-header">Szombat</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
            <!-- Row 7 -->
            <div class="grid-header">Vasárnap</div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div><div><button>+</button></div>
        </div>
    </main>

    <div id="etelValasztas">
        <div id="valasztottEtkezes">
            <p id="valasztottEtkezesText"></p>
        </div>
    </div>

    <?php include("../footer/footer.html"); ?>
    <script src="menutervezo.js"></script>
</body>
    
</html>