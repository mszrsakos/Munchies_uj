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
    <footer>
        <div id="footerFelso">
            <a href="../fooldal/index.html"><div id="logo"><img src="/imgs/munchieslogo.png" id="logoImg"></div></a>
            <div id="socialmedia">
                <div id="imgsRow">
                    <img src="/imgs/facebooklogo.png" alt="">
                    <img src="/imgs/instagramlogo.png" alt="">
                    <img src="/imgs/youtubelogo.png" alt="">
                </div>
            </div>
            <div id="jobboldal">
                <div id="kapcsolat">
                    <p>Adatvédelem</p>
                    <p>Kapcsolatfelvétel</p>
                    <p>Felhasználói feltételek</p>
                    <p>Kapcsolat</p>
                </div>
                <div id="hirlevel">
                    <input type="text" placeholder="E-mail címed">
                    <button style="height: min-content; width: 70%;">Iratkozz fel hírlevelünkre!</button>
                </div>
            </div>
        </div>
        <div id="footerAlso">
            <p>2025 Munchies · Bajai SZC Türr István Technikum<br>Minden jog fenntartva</p>
        </div>
    </footer>
</body>
    
</html>