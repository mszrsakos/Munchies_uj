<?php
    $db_server = "192.168.1.12"; # sulis host
    $db_user = "admin";
    $db_pass = "123";
    $db_name = "munchies";
    $conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    if (!$conn) {
        die("Kapcsolódási hiba: " . mysqli_connect_error());
    }
    # host: xampp control panel -> config my.ini -> bind-address = 0.0.0.0
    # sql: create user 'admin'@'%' identified by '123'; ha nem lenne
    # firewall: win + R -> wf.msc -> inbound rules -> new rule -> port -> TCP 3306 engedélyezése + 80+/443-as port is
    # cmd:(check) "C:\xampp\mysql\bin\mysql.exe" -h 192.168.1.50 -u teamuser -p
    # C:\xampp\apache\conf\extra\ -> httpd-xampp.conf -> "Require local" -> "Require host_ip/all granted"
    # clients: open web: host_ip/phpmyadmin
?>

