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

    $stmt = $conn->prepare("SELECT id AS user_id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($password === $row["password"]) {
            session_regenerate_id(true);
            $_SESSION["email"] = $email;
            $_SESSION["user_id"] = (int)$row["user_id"]; // most már biztosan szám
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