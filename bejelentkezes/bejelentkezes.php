<?php
    session_start();
    
    if (isset($_SESSION["email"])) {
        header("Location: ../fooldal/index.php");
        exit();
    }

    include("../database.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["bejelentkezes"])) {
       
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? ""; 

        if (!$email || empty($password)) {
            $_SESSION["error"] = "Érvénytelen email vagy jelszó!";
            header("Location: ../bejelentkezes/bejelentkezes.php");
            exit();
        }

        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if ($password === $row["password"]) {

                session_regenerate_id(true);

                $_SESSION["email"] = $email;
                $_SESSION["username"] = $row["username"];

                header("Location: ../profil/profil.php");
                exit();
            }
        }

        $_SESSION["error"] = "Érvénytelen email vagy jelszó!";
        header("Location: ../bejelentkezes/bejelentkezes.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="bejelentkezes.css">
    <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>

    <?php include("../header/header.html"); ?>

    <main>
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="email">Email cím:</label> <br>
            <input type="email" id="email" name="email" required> <p class="error" id="emailError"></p> <br>
        
            <label for="password">Jelszó:</label> <br>
            <input type="password" id="password" name="password" required> <p class="error" id="passwordError"></p>
            
            <?php if (isset($_SESSION["error"])): ?>
                <p class="error"><?= $_SESSION["error"]; ?></p>
                <?php unset($_SESSION["error"]); ?>
            <?php endif; ?>
            <button type="submit" name="bejelentkezes" onclick="return loginCheck()">Bejelentkezés</button>
            <p style="color: black;">Nincs még fiókod? <a href="../regisztracio/regisztracio.php" style="color:#6C9995">Regisztrálj itt!</a></p>
        </form>
    </main>

    <?php include("../footer/footer.html"); ?>

    <script src="bejelentkezes.js"></script>
</body>
</html>