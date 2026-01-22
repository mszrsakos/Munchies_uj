<?php
    session_start();

    if (isset($_SESSION["email"])) {
        header("Location: ../fooldal/index.php");
        exit();
    }

    include("../database.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $username = trim($_POST["username"]);
        $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
        $password = trim($_POST["password"]);


        if (empty($username) || empty($email) || empty($password)) {
            die("
                <p>Az összes mezőt ki kell tölteni! Átirányítás 5 másodperc múlva...</p>
                <script>
                    setTimeout(function() {
                        window.location.href = 'regisztracio.php';
                    }, 5000);
                </script>
            ");
        }

        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            die("
                <p>Az email már használatban van. Átirányítás 5 másodperc múlva...</p>
                <script>
                    setTimeout(function() {
                        window.location.href = 'regisztracio.php';
                    }, 5000);
                </script>
            ");
        }
        $stmt->close();

        //$hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if (!$stmt->execute()) {
            die("
                <p>Adatbázis hiba. Átirányítás 5 másodperc múlva...</p>
                <script>
                    setTimeout(function() {
                        window.location.href = 'regisztracio.php';
                    }, 5000);
                </script>
            ");
        }
        $userID = $stmt->insert_id;
        $_SESSION["email"] = $email;
    
        $stmt->close();
        $conn->close();
    };
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="../bejelentkezes/bejelentkezes.css">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <script src="regisztracio.js"></script>
</head>
<body>

    <?php include("../header/header.html"); ?>

    <main>
        <form id="registerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <label for="username">Felhasználónév</label> <br>
            <input type="username" id="username" name="username" required> <br>
            <label for="email">Email cím:</label> <br>
            <input type="email" id="email" name="email" required> <br>
            <label for="password">Jelszó:</label> <br>
            <input type="password" id="password" name="password" required> <br>
        
            <button type="submit">Regisztráció</button>
        </form>
    </main>

    <?php include("../footer/footer.html"); ?>

</body>
</html>