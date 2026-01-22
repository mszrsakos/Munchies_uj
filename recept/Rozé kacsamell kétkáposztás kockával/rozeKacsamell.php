<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rozé kacsamell kétkáposztás kockával</title>
    <link rel="stylesheet" href="rozeKacsamell.css">
    <link rel="stylesheet" href="../../header/header.css">
    <link rel="stylesheet" href="../../footer/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>

    <?php include("../../header/receptHeader.html");?>

    <div class="teljes_oldal">
        <div class="container">
            <div class="left">
                <h1>Rozé kacsamell kétkáposztás kockával</h1>
            <img class="kep" src="../../imgs/roze-kacsamell.jpeg" alt="">
    
            <div class="valami">
                <table class="tapanyag_kaloria">
                    <tr>
                        <th>IDŐ</th>
                        <th>KÖLTSÉG</th>
                        <th style="border: 0px;">NEHÉZSÉG</th>
                    </tr>
                    <tr>
                        <td>80p</td>
                        <td>megfizethető</td>
                        <td style="border: 0px;">könnyű</td>
                    </tr>
                </table>
            </div>
    
    
            <div class="hozzavalok">
                <h1>Hozzávalók</h1>
                
                <div class="counter">
                    <p>Adagok száma</p>
                    <div class="counter2">
                    <button onclick="decrease()">−</button>
                    <span id="count">1</span>
                    <button onclick="increase()">+</button>
                    </div>
                </div>
    
                <ul>
                    
                    <li>1 db kacsamell (2 fél)</li>
                    <li>só ízlés szerint</li>
                    <li>bors ízlés szerint</li>
                    <li>1 db lilahagyma</li>
                    <li>só ízlés szerint</li>
                    <li>bors ízlés szerint</li>
                    <li>őrölt fűszerkömény ízlés szerint</li>
                    <li>3 ek nádcukor</li>
                    <li>0.5 közepes fej vöröskáposzta</li>
                    <li>0.5 közepes fej káposzta</li>
                    <li>3 ek kacsazsír</li>
                    <li>2.5 dl vörösbor</li>
                    <li>45 dkg tészta (főtt)</li>
                </ul>
            </div>
            </div>
    
    
            <div class="right">
                <h1>Elkészítés</h1>
                <ol>
                    <li>A kacsamelleket bőrös oldalát beirdaljuk, elég csak egy irányban, így nem fog csúszkálni a zsírréteg a késünk alatt, és szebb is lesz. Serpenyőt forrósítunk, majd a kacsamelleket bőrrel lefelé beletesszük.</li>
                    <li>Sózzuk-borsozzuk, és aranybarnára pirítjuk a bőrét. Majd megfordítjuk a melleket, sózunk-borsozunk, és a másik oldalukat is lepirítjuk.</li>
                    <li>175 fokos sütőben 20 percet sütjük, az első félidőben érdemes lefedni alufóliával, így még jobban puhul.</li>
                    <li>A kész kacsamelleket hagyjuk pihenni a sütőben, majd amikor már a tészta is kész, a beirdalás mentén felszeleteljük.</li>
                    <li>A kacsasütésről hátramaradt zsíron üvegesre pároljuk a lila hagymát. Sózzuk-borsozzuk, megszórjuk jó adag fűszerköménnyel és pár evőkanál cukorral.</li>
                    <li>Picit karamellizáljuk a hagymát, majd hozzáadjuk a finomra reszelt fehér- és lila káposztát, és addig pároljuk, míg kissé összeesik az egész. Ekkor mindenképpen kóstoljuk meg, és szükség szerint fűszerezzünk utólag is, hiszen nagy volumenváltozáson esik át az ételünk.</li>
                    <li>Adjunk hozzá egy kevés kacsazsírt is pluszban, és öntsük rá a száraz vörösbort. Keverjük át az egészet. Pároljuk addig, míg az alkohol eltűnik belőle, majd kicsit pirongassuk is oda.</li>
                    <li>Végül jöhet bele a kész, kifőtt tésztát. Ebből használhatunk bármilyet, de hagyományosan fodros nagykockát illik használni. Keverjük el a káposztával alaposan, és tálalhatunk is.</li>
                    <li>A káposztás kockát kínáljuk mélytányérakban, a tetejére pedig fektessünk pár szeletet a rozé kacsamellből.</li>
                </ol>
            </div>   
        </div>
    
        <div class="spacer2"></div>
    
    </div>
    <div class="spacer"></div>
    
    <?php include("../../footer/receptFooter.html"); ?>

    <script src="main.js"></script>
</body>
</html>