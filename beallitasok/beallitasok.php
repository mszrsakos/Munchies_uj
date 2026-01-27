<?php
// session_start();
// var_dump($_SESSION);
// die()

/* ---------- BEJELENTKEZÉS ELLENŐRZÉSE ---------- */
// if (!isset($_SESSION["user_id"])) {
//     die("Nem vagy bejelentkezve!");
// }

//$userId = $_SESSION["user_id"];

/* ---------- ADATBÁZIS KAPCSOLAT ---------- */
// try {
//     $pdo = new PDO(
//         "mysql:host=localhost;dbname=munchies;charset=utf8",
//         "felhasznalonev",
//         "jelszo",
//         [
//             PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//         ]
//     );
// } catch (PDOException $e) {
//     die("Adatbázis hiba: " . $e->getMessage());
// }

/* ---------- ADATOK LEKÉRÉSE ---------- */
// $stmt = $pdo->prepare("SELECT username, email, password FROM users WHERE id = ?");
// $stmt->execute([$userId]);
// $user = $stmt->fetch(PDO::FETCH_ASSOC);

// if (!$user) {
//     die("Felhasználó nem található!");
// }

/* ---------- ŰRLAP FELDOLGOZÁSA ---------- */
// $message = "";

// if ($_SERVER["REQUEST_METHOD"] === "POST") {

//     $username = trim($_POST["username"]);
//     $email = trim($_POST["email"]);
//     $oldPassword = $_POST["old_password"];
//     $newPassword = $_POST["new_password"];

    // Régi jelszó ellenőrzése
    // if (!password_verify($oldPassword, $user["password"])) {
    //     $message = "❌ Hibás régi jelszó!";
    // } else {

        // Ha nincs új jelszó megadva, marad a régi
//         if (!empty($newPassword)) {
//             $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
//         } else {
//             $hashedPassword = $user["password"];
//         }

//         $update = $pdo->prepare(
//             "UPDATE users 
//              SET username = ?, email = ?, password = ?
//              WHERE id = ?"
//         );

//         $update->execute([
//             $username,
//             $email,
//             $hashedPassword,
//             $userId
//         ]);

//         $message = "✅ Adatok sikeresen frissítve!";
//     }
// }
// ?> 

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beállítások</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="beallitasok.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
    
    <?php include("../header/header.html");?>
        <div><h1>Személyes adatok módosítása</h1></div>

    <main>
        <form id="registerForm">
            <label for="username">Új felhasználónév</label> <br>
            <input type="username" id="username" name="username" required> <br>

            <label for="email">Új email</label> <br>
            <input type="email" id="email" name="email" required> <br>

            <label for="password">Új jelszó</label> <br>
            <input type="password" id="password" name="password" required> <br>

            <!-- <form method="registerForm">
                <label for="username">Új felhasználónév</label>
                <input type="username" id="username" name="username" required><br>

                <label for="email">Új email</label>
                <input type="email" id="email" name="email" required><br>

                <label for="password">Új jelszó</label>
                <input type="password" id="password" name="password" required   ><br>
            </form> -->
                <div>
                    <button type="submit" class="button1"><a href="../beallitasok/beallitasok.php">Mentés</a></button>
                </div>
            

        
            

        </form>
    </main>

    <?php include("../footer/footer.html");?>

</body>
</html>
