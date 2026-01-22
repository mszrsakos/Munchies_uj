<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="receptek.css">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>

    <?php include("../header/header.html");?>

    <div class="tartalom">
        <!-- bal oldal -->
        <div class="ajanlat">
            <p>Mai ajánlataink:</p>  
        </div>
        <div class="ajanlat_tartalom"> 
            <!-- Tom Yum leves -->
                <div class="img-wrapper">
                        <a class="kepLink" href="../recept/Tom Yum recept/tomYum.php">
                                <img class="kep" src="../imgs/tomyum.jpeg" alt="">
                            
                            <div class="content fade">
                                Tom Yum leves
                            </div>
                        </a>
                </div>
                <!-- Pulyka Wellington módra -->
                <div class="img-wrapper">
                        <a class="kepLink" href="../recept/Pulyka Wellington módra/pulykaWell.php">
                                <img class="kep" src="../imgs/pulyka_wellington.jpeg" alt="">
                            
                            <div class="content fade">
                                Pulyka Wellington módra   
                            </div>
                        </a>
                </div>
                <!-- Rozé kacsamell kétkáposztás kockával -->
                <div class="img-wrapper"  > 
                        <a class="kepLink" href="../recept/Rozé kacsamell kétkáposztás kockával/rozeKacsamell.php">
                                <img class="kep" src="../imgs/roze-kacsamell.jpeg" alt="">
                            
                            <div class="content fade">
                                Rozé kacsamell kétkáposztás kockával
                            </div>  
                        </a>  
                </div>
        </div>
    </div>

    

    <div class="container">
        <form action="" method="get" class="search-bar">
            <input type="text" placeholder="Keresés receptre..." />
            <button type="submit"><img src="../imgs/keresesbtn-removebg-preview.png"></button>
        </form>
    </div>

    <!-- tartalom vege -->


    <!--footer  -->

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


    <!-- footer vege -->
    <script src="main.js"></script>
</body>
</html>