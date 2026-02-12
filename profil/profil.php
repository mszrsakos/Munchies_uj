<?php
    session_start();
    if (!isset($_SESSION["email"])) {
        header("Location: ../bejelentkezes/bejelentkezes.php");
        exit();
    }
    include_once('../database.php');

    $email = $_SESSION['email'] ?? '';

    $username = '';
    if ($email && $stmt = $conn->prepare("SELECT username FROM users WHERE email = ? LIMIT 1")) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($fetched_username);
        if ($stmt->fetch()) {
            $username = $fetched_username;
        }
        $stmt->close();
    }

    // display name
    $display = null;

    if ($email && $stmt = $conn->prepare("SELECT display FROM users WHERE email = ? LIMIT 1")) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($fdisplay);
        if ($stmt->fetch()) $display = $fdisplay;
        $stmt->close();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["display_input"])) {
            $new_display = trim($_POST["display_input"]);
            if ($email && $stmt = $conn->prepare("UPDATE users SET display = ? WHERE email = ?")) {
                $stmt->bind_param("ss", $new_display, $email);
                $stmt->execute();
                $stmt->close();
                $display = $new_display;
                header("Location: profil.php");
                exit();
            }
        }
    }   
    
    // profile pic
    $profile_image_url = null;

    if ($email && $stmt = $conn->prepare("SELECT profile_image_url FROM users WHERE email = ? LIMIT 1")) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($fprofile_image_url);
        if ($stmt->fetch()) $profile_image_url = $fprofile_image_url;
        $stmt->close();
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="profil1.css">
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
            <img class="profil_kep" src="<?= htmlspecialchars($profile_image_url ?? '../imgs/profil_kep-removebg-preview.png') ?>" alt="profilkep">
            </div>
            <div class="adatok">
                <h1 class="nev"><?php if($display === null || trim($display) === '') {
                    echo htmlspecialchars($username);
                } else {
                    echo htmlspecialchars($display);
                }?></h1>
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
            <div class="tartalomElemek">
                <button class="button2"><a href="../beallitasok/beallitasok.php">Személyes adatok módosítása</a></button>
                <button class="button2"><a href="../kijelentkezes.php">Kijelentkezés</a></button>
            </div>
            <form id="profilePicForm"
                action="upload_profilkep.php"
                method="POST"
                enctype="multipart/form-data">

                <h1>Profilkép</h1>

                <input type="file"
                    id="profilePicInput"
                    name="profile_picture"
                    accept="image/*"
                    hidden>

                <button type="button"
                        class="profilkep_gomb"
                        onclick="document.getElementById('profilePicInput').click()">
                    +
                </button>
            </form>
            <form action="profil.php" method="POST">
                <div>
                    <div class="tartalomElemek">
                        
                        <div>
                            <h1>Név</h1>
                            <input type="text" name="display_input" class="display_input">
                        </div>
                    </div>
                <div class="tartalomElemek">
                    <div class="rolam">
                        <h1>Rólam</h1>
                        <textarea name="rolam_input" class="rolam_input"></textarea>
                    </div>   
                </div>
                <button class="button2"  type="submit">Mentés</button>
            </form>
        </div>
         <!-- Tartalom vege -->
    </div>
    
    <?php include("../footer/footer.html"); ?>   

    <script src="profil.js"></script>
</body>
</html>