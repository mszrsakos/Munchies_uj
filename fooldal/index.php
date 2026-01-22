<?php
    session_start();
    
    if (!isset($_SESSION["email"])) {
    header("Location: ../regisztracio/regisztracio.php");
    exit();
    }

    $email = $_SESSION["email"];

    include("../database.php");

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $stmt->close();
    $conn->close();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Munchies</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="../footer/footer.css">
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

<footer>
    <div id="footerFelso">
        <div id="logo"><img src="../imgs/munchieslogo.png" id="logoImg"></div>
        <div id="socialmedia">
            <div id="imgsRow">
                <a href=""><img src="../imgs/facebooklogo.png" alt=""></a>
                <a href=""><img src="../imgs/instagramlogo.png" alt=""></a>
                <a href=""><img src="../imgs/youtubelogo.png" alt=""></a>
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
    <script src="main.js"></script>
</body>
</html>