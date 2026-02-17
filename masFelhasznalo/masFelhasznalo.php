<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

require_once "../database.php";

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="icon" type="image/x-icon" href="../imgs/munchieslogo.png">
    <title>Document</title>
    
</head>
<body>
    <?php include("../header/header.html"); ?>





    <?php include("../footer/footer.html"); ?>   
</body>
</html>