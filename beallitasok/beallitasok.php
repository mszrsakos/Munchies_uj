<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../bejelentkezes/bejelentkezes.php");
    exit();
}

$email = $_SESSION['email'];

include("../database.php");

// Fetch user_id based on the email stored in the session
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    // If no user is found, redirect to login
    header("Location: ../bejelentkezes/bejelentkezes.php");
    exit();
}

$user_id = $user['id']; // Get the user_id

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"])) {
        $username = trim($_POST['username']);
        $new_email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Fetch current user data from the database
        $sql = "SELECT username, email FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $current_user = $result->fetch_assoc();
        $stmt->close();

        // Compare new values with current values
        if ($username !== $current_user['username'] || $new_email !== $current_user['email']) {
            $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $username, $new_email, $user_id);
            $stmt->execute();
            $stmt->close();

            $_SESSION['email'] = $new_email; // Update session email
            header("Location: beallitasok.php");
            exit();
        }
    }
}
?> 

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
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <label for="username">Új felhasználónév</label> <br>
            <input type="username" id="username" name="username"> <br>

            <label for="email">Új email</label> <br>
            <input type="email" id="email" name="email"> <br>

            <label for="password">Új jelszó</label> <br>
            <input type="password" id="password" name="password"> <br>
            <div>
                <button type="submit" class="button1"><a href="../beallitasok/beallitasok.php">Mentés</a></button>
            </div>
        </form>
    </main>

    <?php include("../footer/footer.html");?>

</body>
</html>
