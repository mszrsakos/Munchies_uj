-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Már 02. 09:23
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `munchies`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menu_plan`
--

CREATE TABLE `menu_plan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` enum('Hétfő','Kedd','Szerda','Csütörtök','Péntek','Szombat','Vasárnap') NOT NULL,
  `meal` enum('Reggeli','Ebéd','Vacsora','Egyéb') NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `menu_plan`
--

INSERT INTO `menu_plan` (`id`, `user_id`, `day`, `meal`, `recipe_id`, `created_at`) VALUES
(2, 9, 'Kedd', 'Ebéd', 11, '2026-03-02 08:13:04'),
(3, 9, 'Szerda', 'Vacsora', 13, '2026-03-02 08:13:06'),
(4, 9, 'Hétfő', 'Egyéb', 15, '2026-03-02 08:13:08'),
(5, 9, 'Vasárnap', 'Ebéd', 4, '2026-03-02 08:13:11'),
(6, 9, 'Szombat', 'Ebéd', 12, '2026-03-02 08:13:14');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `base_servings` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `time_minutes` int(11) DEFAULT NULL,
  `cost` varchar(50) DEFAULT NULL,
  `difficulty` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `description`, `image_url`, `base_servings`, `created_at`, `created_by`, `time_minutes`, `cost`, `difficulty`) VALUES
(1, 'Tom Yum édes-savanyú leves', 'Thai csípős-savanykás leves rákkal és gombával.', 'tomyum.jpeg', 1, '2026-02-05 10:58:34', 13, 60, 'megfizethető', 'könnyű'),
(3, 'Pulyka Wellington módra', 'Ropogós leveles tésztába csomagolt, szaftos pulykamell gombás töltelékkel és prosciuttóval – ünnepi, látványos főétel.', 'pulyka_wellington.jpeg', 1, '2026-02-09 08:33:22', 5, 80, 'költséges', 'közepes'),
(4, 'Rozé kacsamell kétkáposztás kockával', 'Rozéra sütött kacsamell, fűszeres kétkáposztás körettel (rozéborral és szőlőlével párolva) – gyorsan elkészül, mégis elegáns.', 'roze-kacsamell.jpeg', 1, '2026-02-09 08:33:22', 7, 80, 'megfizethető', 'könnyű'),
(8, 'Arroz con salchichas', 'Puerto ricói paradicsomos-rizses egytálétel virslivel', 'arrozconsalchichas.jpg', 1, '2026-02-10 11:24:45', 11, 50, 'megfizethető', 'könnyű'),
(9, 'Egyszerű rántott sárgarépa', 'Ropogós panírozott sárgarépaszeletek, gyors és pénztárcabarát.', 'rantott_sargarepa.jpg', 3, '2026-02-12 11:04:41', 5, 40, 'olcsó', 'könnyű'),
(10, 'Kimbap (koreai rizstekercs)', 'Gyors, csomagolható koreai rizstekercs zöldségekkel, omlettel és tonhalkrémmel.', 'kimbap.jpg', 2, '2026-02-12 11:04:48', 10, 15, 'olcsó', 'könnyű'),
(11, 'Ropogós sült banán villámgyorsan', 'Rizslapba tekert, kívül ropogósra sült banán barna cukorral és fahéjjal.', 'sult_banan.jpg', 4, '2026-02-12 11:04:56', 15, 10, 'olcsó', 'könnyű'),
(12, 'Kolbászos-sajtos omlett zabpehellyel', 'Laktató, tojásos omlett kolbásszal, sajttal és zabpehellyel.', 'kolbaszos-sajtos-omlett.jpg', 2, '2026-02-12 11:43:56', 6, 42, 'megfizethető', 'könnyű'),
(13, 'Rákóczi túrós torta házilag', 'Klasszikus túrós sütemény tésztával, túrókrémmel és habbal.', 'rakoczi-turos.jpg', 6, '2026-02-12 11:44:04', 15, 80, 'megfizethető', 'közepes'),
(15, 'Mogyoródarabos krémmel töltött kukoricalisztes linzer', 'Omlós linzerkorongok darabos mogyorókrémmel töltve, ahol minden falatban ott van a ropogós élmény, olyan, mintha ünnep lenne egy kávé mellett.', 'mogyorodarabos-linzer.jpg', 1, '2026-02-12 12:05:48', 6, 57, 'megfizethető', 'könnyű'),
(16, 'Az eredeti sokac cserepes bab', 'Mohács környéki, hosszú ideig főtt, tartalmas babos egytálétel füstölt húsokkal és zöldségekkel.', 'kocsogos-bab.jpeg', 10, '2026-02-16 08:07:07', 8, 210, 'olcsó', 'könnyű'),
(17, 'Egyszerű csörögefánk', 'Gyors, ropogós-omlós farsangi csöröge, porcukorral és lekvárral tálalva.', 'csoroge-fank.jpg', 8, '2026-02-16 08:07:51', 15, 25, 'olcsó', 'könnyű');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `recipe_id`, `amount`, `unit`, `name`) VALUES
(53, 1, 50.00, 'dkg', 'folyami rák'),
(54, 1, 20.00, 'db', 'shiitake gomba'),
(55, 1, 25.00, 'dkg', 'fafülgomba'),
(56, 1, NULL, '', 'citromfű ízlés szerint'),
(57, 1, 2.00, 'db', 'lime leve'),
(58, 1, 2.00, 'db', 'chili paprika'),
(59, 1, 2.00, 'ek', 'szójaszósz'),
(60, 1, 1.00, 'ek', 'halszósz'),
(61, 1, 1.00, 'db', 'újhagyma'),
(62, 1, NULL, '', 'friss koriander ízlés szerint'),
(63, 1, 1.00, 'tk', 'cukor'),
(64, 1, 1.50, 'l', 'hal alaplé'),
(65, 3, 800.00, 'g', 'pulykamell'),
(66, 3, 500.00, 'g', 'csiperkegomba (lehetőleg barna csiperke vagy vegyes erdei gombát válasszunk)'),
(67, 3, 1.00, 'db', 'nagy fej vöröshagyma'),
(68, 3, 3.00, 'db', 'gerezd fokhagyma'),
(69, 3, 200.00, 'g', 'prosciutto'),
(70, 3, 400.00, 'g', 'leves tészta'),
(71, 3, 1.00, 'ek', 'dijoni mustár'),
(72, 3, 1.00, 'db', 'tojás'),
(73, 3, 2.00, 'ek', 'olívaolaj'),
(74, 4, 1.00, 'db', 'kacsamell (2 fél)'),
(75, 4, NULL, '', 'só ízlés szerint'),
(76, 4, NULL, '', 'bors ízlés szerint'),
(77, 4, 1.00, 'db', 'lilahagyma'),
(78, 4, NULL, '', 'só ízlés szerint'),
(79, 4, NULL, '', 'bors ízlés szerint'),
(80, 4, NULL, '', 'fűszerkömény ízlés szerint'),
(81, 4, NULL, '', 'cukor ízlés szerint'),
(82, 4, 1.00, 'db', 'vöröskáposzta'),
(83, 4, 1.00, 'db', 'fejeskáposzta'),
(84, 4, 150.00, 'ml', 'száraz rozébor'),
(85, 4, 150.00, 'ml', 'szőlőlé'),
(86, 4, 1.00, 'db', 'szegfűszeg'),
(147, 8, NULL, '', '## A klasszikus puerto ricói sofritóhoz'),
(148, 8, 0.30, '', 'kis fej vöröshagyma'),
(149, 8, 0.30, 'db', 'zöld kaliforniai paprika'),
(150, 8, 0.80, 'gerezd', 'fokhagyma'),
(151, 8, 0.30, 'csokor', 'koriander'),
(152, 8, NULL, '', '## Az arroz con salchichas-hoz'),
(153, 8, 0.50, 'ek', 'napraforgó olaj'),
(154, 8, 62.50, 'g', 'virsli'),
(155, 8, 0.80, 'ek', 'sűrített paradicsom'),
(156, 8, 2.50, 'db', 'olajbogyó'),
(157, 8, 0.30, 'teáskanál', 'kapribogyó'),
(158, 8, 0.10, 'teáskanál', 'füstölt pirospaprika'),
(159, 8, 0.10, 'kávéskanál', 'római kömény'),
(160, 8, 0.10, 'kávéskanál', 'fokhagymapor'),
(161, 8, 0.30, 'csipet', 'oregánó'),
(162, 8, NULL, '', 'fekete bors ízlés szerint'),
(163, 8, NULL, '', 'só ízlés szerint'),
(164, 8, 75.00, 'g', 'jázmin rizs'),
(165, 8, 0.30, 'db', 'babérlevél'),
(166, 8, 162.50, 'ml', 'alaplé (opcionális vagy szűrt víz)'),
(167, 9, 2.00, 'db', 'nagy sárgarépa'),
(168, 9, 100.00, 'g', 'finomliszt'),
(169, 9, 100.00, 'g', 'zsemlemorzsa'),
(170, 9, 1.00, 'db', 'tojás (nagy)'),
(171, 9, NULL, '', 'só ízlés szerint'),
(172, 9, 50.00, 'ml', 'napraforgó olaj'),
(173, 10, 400.00, 'g', 'főtt rizs'),
(174, 10, 2.00, 'db', 'nori lap'),
(175, 10, 2.00, 'db', 'tojás'),
(176, 10, 1.00, 'db', 'kis sárgarépa'),
(177, 10, 50.00, 'g', 'spenót'),
(178, 10, 100.00, 'g', 'savanyított retek (daikon)'),
(179, 10, 100.00, 'g', 'kígyóuborka'),
(180, 10, 80.00, 'g', 'tonhalkonzerv (1 doboz)'),
(181, 10, 1.00, 'ek', 'majonéz'),
(182, 10, NULL, '', 'gochugaru chili (opcionális)'),
(183, 10, 1.00, 'dl', 'szezámolaj'),
(184, 10, 2.00, 'tk', 'szezámmag'),
(185, 10, 1.00, 'ek', 'napraforgó olaj (omletthez)'),
(186, 10, NULL, '', 'só'),
(187, 11, 3.00, 'db', 'banán'),
(188, 11, 12.00, 'csipet', 'barna cukor (a banánokra)'),
(189, 11, 12.00, 'db', 'rizslap'),
(190, 11, NULL, '', 'fahéj ízlés szerint'),
(191, 11, 2.00, 'ek', 'karamell öntet (opcionális)'),
(192, 11, 200.00, 'g', 'vanília fagylalt (opcionális)'),
(193, 11, 3.00, 'dl', 'napraforgó olaj'),
(194, 12, 0.50, 'ek', 'vaj'),
(195, 12, 6.00, 'dkg', 'paprikás kolbász'),
(196, 12, 5.00, 'db', 'tojás'),
(197, 12, 3.00, 'ek', 'zabpehely'),
(198, 12, 10.00, 'dkg', 'sajt'),
(199, 12, NULL, '', 'só (ízlés szerint)'),
(200, 12, NULL, '', 'bors (ízlés szerint)'),
(201, 12, NULL, '', 'chilipehely (ízlés szerint)'),
(202, 13, NULL, '', '## Tészta'),
(203, 13, 260.00, 'g', 'vaj (hideg)'),
(204, 13, 390.00, 'g', 'finomliszt'),
(205, 13, 130.00, 'g', 'porcukor'),
(206, 13, 1.00, 'tk', 'só'),
(207, 13, 1.00, 'tk', 'sütőpor (púpos)'),
(208, 13, 1.00, 'db', 'tojás'),
(209, 13, NULL, '', '## Túrókrém'),
(210, 13, 650.00, 'g', 'tehéntúró'),
(211, 13, 3.00, 'db', 'tojássárgája'),
(212, 13, 100.00, 'g', 'porcukor'),
(213, 13, 1.00, 'ek', 'tejföl'),
(214, 13, 0.50, 'db', 'citromhéj (ízlés szerint)'),
(215, 13, 100.00, 'g', 'sárgabaracklekvár (ízlés szerint)'),
(216, 13, NULL, '', '## Hab'),
(217, 13, 3.00, 'db', 'tojásfehérje'),
(218, 13, 75.00, 'g', 'porcukor'),
(219, 13, 1.00, 'csipet', 'só'),
(228, 15, 4.00, 'dkg', 'kukoricaliszt'),
(229, 15, 8.00, 'dkg', 'finomliszt'),
(230, 15, 6.00, 'dkg', 'margarin'),
(231, 15, 0.40, 'ek', 'sertészsír'),
(232, 15, 1.40, 'csapott ek', 'porcukor'),
(233, 15, 0.20, 'csomag', 'porcukor'),
(234, 15, 0.20, 'tk', 'porcukor'),
(235, 15, 0.30, 'csomag', 'sütőpor'),
(236, 15, 3.00, 'dkg', 'nutella (mogyoródarabos mogyorókrém)'),
(237, 16, 80.00, 'dkg', 'fejtett bab (tarka, nagyszemű)'),
(238, 16, 50.00, 'dkg', 'füstölt sertéscsülök (vagy füstölt hús kockázva)'),
(239, 16, 50.00, 'dkg', 'marhalábszár (vagy sertéscomb kockázva)'),
(240, 16, 100.00, 'g', 'csípős kolbász (opcionális, karikázva)'),
(241, 16, 4.00, 'db', 'sárgarépa (hasábokra vágva)'),
(242, 16, 3.00, 'db', 'fehérrépa (hasábokra vágva)'),
(243, 16, 1.00, 'fej', 'vöröshagyma (kockázva)'),
(244, 16, 1.00, 'fej', 'fokhagyma (egészben)'),
(245, 16, 1.00, 'db', 'zeller (negyedelve)'),
(246, 16, 4.00, 'db', 'babérlevél'),
(247, 16, 1.00, 'ek', 'fűszerpaprika'),
(248, 16, NULL, '', 'só (ízlés szerint)'),
(249, 16, NULL, '', 'bors (ízlés szerint)'),
(250, 16, 2.00, 'db', 'zöldpaprika (1 a főzéshez, 1 csípős a tálaláshoz)'),
(251, 16, 1.00, 'csokor', 'petrezselyem (tálaláshoz)'),
(252, 17, 250.00, 'g', 'finomliszt'),
(253, 17, 1.00, 'tk', 'só'),
(254, 17, 30.00, 'g', 'porcukor'),
(255, 17, 50.00, 'g', 'vaj'),
(256, 17, 3.00, 'db', 'tojássárgája'),
(257, 17, 3.00, 'ek', 'tejföl'),
(258, 17, 1.00, 'ek', 'rum'),
(259, 17, 1000.00, 'ml', 'napraforgó olaj (sütéshez)'),
(260, 17, NULL, '', 'porcukor + lekvár (tálaláshoz)');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `recipe_steps`
--

CREATE TABLE `recipe_steps` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `step_no` int(11) NOT NULL,
  `step_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `recipe_steps`
--

INSERT INTO `recipe_steps` (`id`, `recipe_id`, `step_no`, `step_text`) VALUES
(1, 1, 1, 'A shiitake és fafül gombát beáztatjuk meleg vízben legalább 1 órára.'),
(2, 1, 2, 'A rákokat megtisztítjuk, a páncélokat kevés olajon pirítjuk, majd alaplevet főzünk belőlük.'),
(3, 1, 3, 'Az alaplében megfőzzük a gombákat.'),
(4, 1, 4, 'Szójaszósszal és halszósszal ízesítjük.'),
(5, 1, 5, 'Hozzáadjuk a lime levét és cukrot ízlés szerint.'),
(6, 1, 6, 'A rákhúst a végén adjuk hozzá, majd korianderrel tálaljuk.'),
(7, 3, 1, 'Tisztítsuk meg a pulykamellet, majd sózzuk és borsozzuk meg. Ha nagyobb darab vagy több vékonyra szeletelt pulykamellünk van, kötözzük össze hengeralakúra.'),
(8, 3, 2, 'Egy serpenyőben melegítsük fel az olívaolajat, és minden oldalán pirítsuk meg a pulykát, hogy szép kérget kapjon. Tegyük félre hűlni.'),
(9, 3, 3, 'A gombás töltelékhez (duxelles) aprítsuk fel nagyon apróra a gombát (nyugodtan tehetjük késes aprítógépbe is), a vöröshagymát és fokhagymát is. A serpenyőben, kevés olajon, közepes lángon pároljuk puhára a hagymát, majd adjuk hozzá a gombát és fokhagymát. Főzzük addig, amíg a gombából elpárolog a nedvesség, és krémes állagú lesz. Ízesítsük egy kis konyakkal vagy sherryvel, kakukkfűvel, rozmaringgal sóval és borssal. Hagyjuk kihűlni a gombás keveréket.'),
(10, 3, 4, 'Egy üres és tiszta munkafelületen terítsünk ki egy nagy darab frissentartó fóliát. Fektessük rá a sonkaszeleteket úgy, hogy kissé fedjék egymást. Egyenletesen oszlassuk el a gombás keveréket a sonka tetején. Ha összekötöztük a pulykát, vágjuk le róla kötözőanyagot, majd kenjük be a kihűlt pulykamellet vékony réteg dijoni mustárral, végül helyezd a gombás-sonkás réteg közepére.'),
(11, 3, 5, 'A fólia segítségével szorosan tekerjük fel a sonkás-gombás réteget a pulyka köré. Győződjünk meg róla, hogy teljesen befedi a húst. Tegyük a hűtőbe 20-30 percre, hogy megszilárduljon.'),
(12, 3, 6, 'Lisztezett felületen nyújtsuk ki a leveles tésztát. Vegyük ki a pulykát a fóliából, és helyezzük a tészta közepére. Kenjük meg a tészta széleit felvert tojással.'),
(13, 3, 7, 'Tekerd rá a tésztát a pulykára úgy, hogy minden oldalról befedje. A tészta végeit is zárd le. A tészta tetejét díszítheted rácsozással vagy bevágásokkal.'),
(14, 3, 8, 'Helyezd a becsomagolt pulykát sütőpapírral bélelt tepsire. Kend meg a tetejét tojással, majd süsd előmelegített 200°C-os sütőben 35-40 percig, amíg aranybarna és ropogós lesz.'),
(15, 3, 9, 'Hagyd pihenni 10 percig, majd szeleteld fel és tálald.'),
(16, 4, 1, 'A kacsamelleket bőrös oldalát beirdaljuk, elég csak egy irányban, így nem fog csúszkálni a zsírréteg a késünk alatt, és szebb is lesz. Serpenyőt forrósítunk, majd a kacsamelleket bőrrel lefelé beletesszük.'),
(17, 4, 2, 'Sózzuk-borsozzuk, és aranybarnára pirítjuk a bőrét. Majd megfordítjuk a melleket, sózunk-borsozunk, és a másik oldalukat is lepirítjuk.'),
(18, 4, 3, '175 fokos sütőben 20 percet sütjük, az első félidőben érdemes lefedni alufóliával, így még jobban puhul.'),
(19, 4, 4, 'A kész kacsamelleket hagyjuk pihenni a sütőben, majd amikor már a tészta is kész, a beirdalás mentén felszeleteljük.'),
(20, 4, 5, 'A kacsasütésről hátramaradt zsíron üvegesre pároljuk a lila hagymát. Sózzuk-borsozzuk, megszórjuk jó adag fűszerköménnyel és pár evőkanál cukorral.'),
(21, 4, 6, 'Hozzáadjuk a felcsíkozott fejes- és vöröskáposztát. Addig pároljuk, amíg összeesik.'),
(22, 4, 7, 'Felöntjük a rozéborral és a szőlőlével. Hozzáadjuk a szegfűszeget.'),
(23, 4, 8, 'Közepes lángon addig főzzük/pároljuk, amíg a káposzta megpuhul és az ízek összeérnek.'),
(24, 4, 9, 'A szeletelt rozé kacsamellet a kétkáposztás körettel tálaljuk.'),
(59, 8, 1, '--A klasszikus puerto ricói sofritóhoz--'),
(60, 8, 2, 'Minden zöldséget durvára vágjunk fel. Tegyük aprítógépbe vagy turmixba, pürésítsük nedves, kissé darabos krémmé (ne teljesen simára!). Az állaga olyan legyen, mint egy sűrű zöld pesztóé.'),
(61, 8, 3, 'Hűtőben 4–5 napig tárolható, fagyasztva jégkockatartóban akár 2–3 hónapig (főzéshez csak bedobunk 1–2 kockát).'),
(62, 8, 4, '--Az arroz con salchichas-hoz--'),
(63, 8, 5, 'Egy nagy serpenyőben vagy lábasban hevítsük fel az olajat, pirítsuk meg a virslikarikákat, amíg kissé megpirulnak és illatosak lesznek.'),
(64, 8, 6, 'Keverjünk bele nagyjából 3 evőkanál sofritót, és süssük 2–3 percig, amíg nagyon illatos lesz.'),
(65, 8, 7, 'Adjuk hozzá a paradicsompürét és/vagy sűrített paradicsomot, apróra vágott olívát és kapribogyót. Főzzük pár percig, amíg sűrű szószt nem kapunk.'),
(66, 8, 8, 'Jöhet a fűszerezés: eredetileg adobóval és sazón fűszerkeverékkel ízesítik, ha nem kapunk, akkor helyettesítsük füstölt egy teáskanál édes paprikával, fél kávéskanál őrölt római köménnyel, fél kávéskanál fokhagymaporral, egy csipet oregánóval, kurkumával és sóval - ízlés szerint (ízben kb. 90%-ban hozza a sazón karakterét) és egy babérlevéllel.'),
(67, 8, 9, 'Adjuk hozzá a rizst, keverjük át, hogy minden szem bevonódjon a szószban.'),
(68, 8, 10, 'Öntsük fel alaplével vagy szűrt vízzel, forrás után fedjük le, és kis lángon főzzük, amíg teljesen megpuhul a rizs - nagyjából 20–30 percig. Időnként finoman kevergessük meg, hogy a rizs ne tapadjon le a serpenyő alján. Akkor lesz jó az állaga, ha nem túl száraz, hanem szaftos marad a rizs.'),
(69, 8, 11, 'Vegyük le a tűzről, pihentessük 5 percig, majd villával lazítsuk fel.'),
(70, 8, 12, 'Tálalhatjuk kockázott avokádóval és sült főzőbanánnal.'),
(71, 9, 1, 'A répát megmossuk, meghámozzuk, kb. ujjnyi darabokra vágjuk, majd hosszában vékony szeletekre.'),
(72, 9, 2, 'Enyhén sós vízben félpuhára főzzük, leszűrjük és hagyjuk alaposan lecsöpögni/száradni.'),
(73, 9, 3, 'Panírozzuk: liszt → felvert tojás → zsemlemorzsa.'),
(74, 9, 4, 'Forró olajban mindkét oldalát aranybarnára sütjük.'),
(75, 9, 5, 'Papírtörlőn lecsepegtetjük, melegen tálaljuk (pl. rizzsel, savanyúsággal).'),
(76, 10, 1, 'Omlettet sütünk a tojásból, csíkokra vágjuk. A répát csíkozzuk és röviden megpároljuk. Az uborkát kimagozzuk és csíkokra vágjuk, a daikont szintén csíkozzuk.'),
(77, 10, 2, 'A spenótot leforrázzuk, lecsepegtetjük, majd kevés szezámolajjal és szezámmaggal ízesítjük (só opcionális).'),
(78, 10, 3, 'A tonhalat elkeverjük majonézzel, kevés szezámolajjal és opcionálisan koreai chilivel.'),
(79, 10, 4, 'A főtt rizst sóval és szezámolajjal összeforgatjuk.'),
(80, 10, 5, 'Nori lapra egyenletesen eloszlatjuk a rizst úgy, hogy a felső szélén maradjon egy kis üres sáv.'),
(81, 10, 6, 'Középre tesszük a töltelékeket (uborka, répa, daikon, omlett, spenót, tonhal), majd szorosan feltekerjük.'),
(82, 10, 7, 'A tekercset kívül lekenjük kevés szezámolajjal, megszórjuk szezámmaggal, majd szeleteljük.'),
(83, 11, 1, 'A banánokat meghámozzuk: félbevágjuk, majd hosszában is kettévágjuk a darabokat.'),
(84, 11, 2, 'A rizslapokat benedvesítjük, a szélére tesszük a banánt, megszórjuk barna cukorral és fahéjjal, majd a rizslapot felhajtva feltekerjük.'),
(85, 11, 3, 'Forró olajban aranybarnára sütjük, papírtörlőn lecsepegtetjük.'),
(86, 11, 4, 'Tálalás: mehet rá méz/karamell/mogyorókrém, és nagyon jó fagyival.'),
(87, 12, 1, 'A kolbászt karikázd fel, a sajtot reszeld le.'),
(88, 12, 2, 'A tojásokat verd fel, keverd hozzá a zabpelyhet, fűszereket, majd a sajtot.'),
(89, 12, 3, 'Vajon pirítsd meg a kolbászt, majd öntsd rá a tojásos keveréket.'),
(90, 12, 4, 'Közepes lángon süsd készre, igény szerint fordítsd/lefedd a gyorsabb átsüléshez.'),
(91, 13, 1, '## Tészta'),
(92, 13, 2, 'A hideg vajból és a száraz hozzávalókból morzsás alapot készíts, add hozzá a tojást, és gyorsan gyúrd össze.'),
(93, 13, 3, 'Nyújtsd ki, formába tedd, majd részben elősüsd.'),
(94, 13, 4, '## Túrókrém'),
(95, 13, 5, 'A túrót keverd ki a sárgájákkal, porcukorral, tejföllel és citromhéjjal. Simítsd az elősütött alapra.'),
(96, 13, 6, '## Hab + befejezés'),
(97, 13, 7, 'A fehérjét verd kemény habbá a cukorral és csipet sóval, majd nyomózsákkal díszíts a tetejére.'),
(98, 13, 8, 'Süsd készre, a lekvárt ízlés szerint használd rétegként/kenéshez a tetején vagy díszítésnél.'),
(103, 15, 1, 'A liszteket a porcukorral, vaníliás cukorral, aromával, tojássárgájával, margarinnal, sütőporral összegyúrjuk sima tésztává.'),
(104, 15, 2, 'Enyhén lisztezett deszkán kinyújtjuk 6-7 mm vékonyra. Kiszúróval kiszaggatjuk, a tészta felét egészben hagyjuk, a másik felének közepét kisebb lyukú kiszúróval.'),
(105, 15, 3, 'Sütőpapíros tepsire tesszük. Előmelegített sütőben megsütjük 200 fokon. Miután világosra sült, még melegen az alját megkenjük a darabos mogyorókrémmel, majd ráhelyezzük a lyukas felét. Még a lyuk közepébe is teszünk a krémből.'),
(106, 15, 4, 'Állni is hagyhatjuk, de neki is foghatunk a kóstolásnak. Jó étvágyat!'),
(107, 16, 1, 'A babot előző este áztasd be hideg vízbe (ha kimarad, hosszú főzéssel így is megpuhulhat).'),
(108, 16, 2, 'Cserépedényben rétegezd: bab → hagymák → füstölt húsok + kolbász → bab, és így tovább. Öntsd fel bő vízzel, a tetejére mehet a babérlevél.'),
(109, 16, 3, 'Tedd a cserépedényt a tűz mellé úgy, hogy csak az egyik oldala kapjon hőt. Lassan melegítsd fel; ha hab képződik, szedd le.'),
(110, 16, 4, 'Kb. 1,5 óra főzés után add hozzá a paprikát és a zöldségeket. Sózd-borsozd óvatosan (a füstölt hús is sós).'),
(111, 16, 5, 'Főzd tovább összesen kb. 3 órát, amíg a bab teljesen megpuhul (babfajtától függően változhat).'),
(112, 16, 6, 'Tálaláskor szórd meg petrezselyemmel; mehet mellé csípős paprika, tejföl és friss kenyér.'),
(113, 17, 1, 'A hozzávalókból gyorsan állíts össze egynemű, rugalmas tésztát (ne gyúrd túl sokáig, hogy omlós maradjon).'),
(114, 17, 2, 'Lisztezett felületen nyújtsd kb. 4–5 mm vékonyra, vágd csíkokra, majd téglalapokra, a közepükön ejts egy bevágást.'),
(115, 17, 3, 'A bevágáson húzd át az egyik sarkot, így kialakul a csöröge forma.'),
(116, 17, 4, 'Forró olajban süsd aranybarnára mindkét oldalon, majd csepegtesd le papíron. Porcukorral és lekvárral tálald.');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `display` varchar(50) NOT NULL,
  `profile_image_url` varchar(255) NOT NULL,
  `about_me` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `display`, `profile_image_url`, `about_me`) VALUES
(5, 'Handras', 'izomagy@sugogym.hu', 'bench', 'BandiGym123', '../uploads/profile_a7f69261ec4d304eb8e604996efafe64.png', 'Gym szív gym lélek, gymben leszek amíg élek\r\nde a kaja bármikor jöhet:)'),
(6, 'lagzi', 'nemvagyoklagzilajcsi@gmail.com', 'ALagziLajcsi', 'Lajcsi', '../uploads/profile_ed47e80381c90c689fd4d9d5cb589647.jpg', 'Nem, nem vagyok Lagzi Lajcsi'),
(7, 'david123', 'david10@gmail.com', 'davidalegjobb', 'PDávid', '../uploads/profile_2cf58254c819311822a7a6ea46556139.png', 'Kíméljetek a vega kajáktól'),
(8, 'mariahorvath', 'horvath99@gmail.com', 'horvathm', 'HorváthM99', '../uploads/profile_2e7d69dff7d2431074833b5d68b8c3dd.png', 'Nem lennék ki kéne találni'),
(9, 'desszertes', 'desszertbarmikor@gmail.com', 'desszertfanatik', 'CsakADesszert', '../uploads/profile_edd60a346545091c50c323494d17ff66.png', ''),
(10, 'CSAKAHÚS', 'mindenamihus@gmail.com', 'csakahus2', 'Húsimádó', '../uploads/profile_630ec39ed0f230044e890edbfaf0831c.jpg', 'Minden ami hús, jöhet:D'),
(11, 'Sanyi23', 'sanyiabajnok@gmail.com', 'Sanyivagyok1!', 'Tésztaimádó', '../uploads/profile_3c4a0b1ecc82e005dcde87d861d4418d.png', ''),
(13, 'ferikiraly', 'kiralyferi@turr.hu', 'aaaa', 'KirályFeri', '../uploads/profile_9c788a3dcf59cd6e66e812fa937fcd22.png', 'Papagájokat imádom!!!!'),
(15, 'akos1', 'akos1@akos1.com', 'aaaa', 'Főni', '../uploads/profile_acea3e800713cdcc38d33605147acf4a.png', 'Szia, Főni vagyok!');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `menu_plan`
--
ALTER TABLE `menu_plan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_slot` (`user_id`,`day`,`meal`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- A tábla indexei `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recipes_created_by` (`created_by`);

--
-- A tábla indexei `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- A tábla indexei `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_step` (`recipe_id`,`step_no`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `menu_plan`
--
ALTER TABLE `menu_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT a táblához `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT a táblához `recipe_steps`
--
ALTER TABLE `recipe_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `menu_plan`
--
ALTER TABLE `menu_plan`
  ADD CONSTRAINT `menu_plan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_plan_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_recipes_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Megkötések a táblához `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `recipe_ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD CONSTRAINT `recipe_steps_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
