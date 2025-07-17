<?php
            session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Promotions</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/boutique.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/cart_panier.css">

    <script src="../scripts/cart.js" defer></script>
    <script src="../scripts/add_to_cart.js" defer></script>
</head>
<body>
<?php require_once "utilities/nav-bar.php" ?>

<main>
    <div class="text">
        <h1>Panier</h1>
        <p style="color: indianred">
            <?php

            if (isset($_SESSION["denied"])) {
                echo "<p style='color:indianred;'>{$_SESSION["denied"]}</p>";
                unset($_SESSION["denied"]); // remove it so it doesn’t show again
            }
            ?>


        </p>
    </div>
    <?php require_once "utilities/cart_panier.php" ?>
    
</main>

<?php require_once "utilities/footer.php" ?>
</body>
</html>
