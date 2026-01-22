<?php
    session_start();
    session_unset();
    session_destroy();
    header("Location: /munchies/bejelentkezes/bejelentkezes.php");
    exit();
?>