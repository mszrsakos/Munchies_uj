<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="tomYum.css">
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
            <h1>Tom Yum édes-savanyú leves</h1>
        <img class="kep" src="../../imgs/tomyum.jpeg" alt="">

        <div class="valami">
            <table class="tapanyag_kaloria">
                <tr>
                    <th>IDŐ</th>
                    <th>KÖLTSÉG</th>
                    <th style="border: 0px;">NEHÉZSÉG</th>
                </tr>
                <tr>
                    <td>60p</td>
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
                <li>50 dkg folyami rák (20 db rákfarok)</li>
                <li>20 db shiitake gomba</li>
                <li>25 dkg fafülgomba</li>
                <li>citromfű ízlés szerint (2 db)</li>
                <li>2 lime-ból nyert limelé</li>
                <li>2 db chili</li>
                <li>2 ek szójaszósz</li>
                <li>1 ek halszósz</li>
                <li>1 közepes db újhagyma</li>
                <li>koriander ízlés szerint</li>
                <li>1 teáskanál cukor</li>
                <li>1.5 l hal alaplé</li>
            </ul>
        </div>
        </div>


        <div class="right">
            <h1>Elkészítés</h1>
            <ol>
                <li>A shiitake és fafül gombát beáztatjuk meleg vízben a főzés előtt legalább 1 órával, ha megpuhult, a fafül gombából kivágjuk a kemény fás tönkrészeket, és vékony, fél centis csíkokra szeleteljük, a shiitake gombát elég negyedelni vagy felezni.</li>
                <li>A rákokat megtisztítjuk a páncéljuktól.</li>
                <li>A páncélokat egy edényben kevés olajon szép pirosra pirítjuk, majd felöntjük annyi vízzel vagy leves alaplével, hogy ellepje, hozzá tesszük a chili paprikát természetesen ízlés szerint és a felaprított citromfüvet, főzzünk alaplevet belőlük.</li>
                <li>Másik lábasban elkezdjük főzni a leves alaplé maradékában a gombákat, forrás után 5-10 perccel kezdhetjük ízesíteni, 2-3 ek szójaszósszal és 1 ek halszósszal.</li>
                <li>Beleszűrjük a rákpáncélos alaplét, és belecsavarunk egy lime levét, most kóstolhatjuk először, lényegében egy édesen savanykás, de viszonylag intenzíven csípős ízt kell kapnunk, így elképzelhető, hogy kell bele 1-2 tk cukor is vagy a szójaszósz és halszósz is.</li>
                <li> A rákhúst elég a tálalás előtt 5-10 perccel beletenni és egyszer felforralni, akkor jó a rák, amikor szép rózsaszín lesz, ha túlfőzzük, akkor egy gumisan rágós dolgot kapunk.</li>
                <li>A felaprított korianderzöldet tényleg csak tálalás előtt dobjuk bele, egyszer elkeverjük és kész!</li>
                <li>Egy csészébe kiszedjük a gombákat, tetejébe a rákfarkak, és meglocsoljuk a forró levessel, tetejét kevés aprított újhagymával szórjuk meg.</li>
                <li>Bolondíthatjuk levesünket udon tésztával vagy szója babcsírával is.</li>
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