<?php
require_once "../database.php";

$q = trim($_GET["q"] ?? "");

if ($q !== "") {
  $stmt = mysqli_prepare($conn, "SELECT id, title, image_url FROM recipes WHERE title LIKE ? ORDER BY created_at DESC");
  $like = "%".$q."%";
  mysqli_stmt_bind_param($stmt, "s", $like);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
} else {
  $result = mysqli_query($conn, "SELECT id, title, image_url FROM recipes ORDER BY created_at DESC");
}

function h($s){ return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptek</title>
    <link rel="stylesheet" href="receptek.css">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>

    <?php include("../header/header.html");?>

    <div class="tartalom">
        <!-- bal oldal -->
        <div class="ajanlat">
            <p>Mai ajánlataink:</p>  
        </div>
        <div class="ajanlat_tartalom"> 
            <!-- Tom Yum leves -->
                <div class="img-wrapper">
                    <a class="kepLink" href="../recept_sema/recept.php?id=1">
                        <img class="kep" src="../imgs/tomyum.jpeg" alt="">
                        <div class="content fade">Tom Yum leves</div>
                    </a>
                </div>
                <!-- Pulyka Wellington módra -->
                <div class="img-wrapper">
                        <a class="kepLink" href="../recept_sema/recept.php?id=3">
                                <img class="kep" src="../imgs/pulyka_wellington.jpeg" alt="">
                            
                            <div class="content fade">
                                Pulyka Wellington módra   
                            </div>
                        </a>
                </div>
                <!-- Rozé kacsamell kétkáposztás kockával -->
                <div class="img-wrapper"  > 
                        <a class="kepLink" href="../recept_sema/recept.php?id=4">
                                <img class="kep" src="../imgs/roze-kacsamell.jpeg" alt="">
                            
                            <div class="content fade">
                                Rozé kacsamell kétkáposztás kockával
                            </div>  
                        </a>  
                </div>
        </div>

            <!-- jobb oldal -->
            
        
        
        <!-- search bar -->
        <div class="container">
        <form action="" method="get" class="search-bar" autocomplete="off">
            <input type="text" name="q" value="<?= h($_GET["q"] ?? "") ?>" placeholder="Keresés receptre..." />
            <button type="submit"><img src="../imgs/keresesbtn-removebg-preview.png"></button>
        </form>

        </div>

        <!-- search bar vege -->

        <div class="receptTartalom">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <div class="img-wrapper">
                            <a class="kepLink" href="../recept_sema/recept.php?id=<?= (int)$row["id"] ?>">
                                <img class="kep" src="../imgs/<?= h($row["image_url"]) ?>" alt="">
                                <div class="content fade"><?= h($row["title"]) ?></div>
                            </a>
                        </div>
                <?php endwhile; ?>
        </div>

    <!-- tartalom vege -->

    <?php include("../footer/footer.html");?>
    
    <script src="main.js"></script>
</body>
</html>