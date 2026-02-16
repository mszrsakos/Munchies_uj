<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: ../bejelentkezes/bejelentkezes.php");
    exit();
}

$email = $_SESSION['email'];

include("../database.php");

/* Fetch user_id */
$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

if (!$user) {
    header("Location: ../bejelentkezes/bejelentkezes.php");
    exit();
}

$user_id = $user['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $new_username = trim($_POST['username'] ?? '');
    $new_email    = trim($_POST['email'] ?? '');
    $new_password = trim($_POST['password'] ?? '');

    /* Fetch current user data */
    $sql = "SELECT username, email, password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $current_user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    $errors = [];

    /* Check username availability */
    if ($new_username !== "" && $new_username !== $current_user['username']) {
        $sql = "SELECT id FROM users WHERE username = ? AND id != ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_username, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Ez a felhasználónév már foglalt.";
        }
        $stmt->close();
    }

    /* Check email availability */
    if ($new_email !== "" && $new_email !== $current_user['email']) {
        $sql = "SELECT id FROM users WHERE email = ? AND id != ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_email, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Ez az email cím már használatban van.";
        }
        $stmt->close();
    }

    /* Stop if errors exist */
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: beallitasok.php");
        exit();
    }

    /* Update username */
    if ($new_username !== "" && $new_username !== $current_user['username']) {
        $sql = "UPDATE users SET username = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_username, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    /* Update email */
    if ($new_email !== "" && $new_email !== $current_user['email']) {
        $sql = "UPDATE users SET email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_email, $user_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['email'] = $new_email;
    }

    /* Update password (still plaintext – see note below) */
    if ($new_password !== "") {
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_password, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: ../profil/profil.php");
    exit();
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
    <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
    
    <?php include("../header/header.html");?>
        <div><h1>Személyes adatok módosítása</h1></div>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <label for="username">Új felhasználónév</label> <br>
            <input type="username" id="username" name="username"> <br>

            <label for="email">Új email</label> <br>
            <input type="email" id="email" name="email"> <br>

            <label for="password">Új jelszó</label> <br>
            <input type="password" id="password" name="password"> <br>
            <div>
                <button type="submit" class="button1">Mentés</button>
            </div>

            <?php if (isset($_SESSION['errors'])): ?>
                <div style="color: red; margin-top: 10px;">
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>
        </form>
    </main>

    <?php include("../footer/footer.html");?>

</body>
</html>
