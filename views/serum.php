<?php
session_start();

require_once '../controllers/product_display.php';
$t = "serums";

$result = product_display("serums");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Serums</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/product.css">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../styles/boutique.css">
    <link rel="stylesheet" href="../styles/cart.css">
    <script src="../scripts/cart.js" defer></script>
    <script src="../scripts/add_to_cart.js" defer></script>
</head>
<body>
<?php require_once "utilities/nav-bar.php"?>
<?php require_once "utilities/cart.php"?>

<main>
    <div class="text">
        <h1>Serums</h1>
    </div>
    <div class="search-input">
        <input type="text" id="searchInput" placeholder="Rechercher un produit" style="padding: 10px; width: 300px; font-size: 16px;">
    </div>
             <div class="filter-container">
      <select id="sortSelect">
        <option value="">-- Trier par prix --</option>
        <option value="asc">Prix croissant</option>
        <option value="desc">Prix décroissant</option>
      </select>
</div>
    <div class="products-container" >
        <?php  if (mysqli_num_rows($result) > 0) : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="product-card">
                        <?php $cartText = "<i class='fa-solid fa-cart-shopping'></i>";
                        require "utilities/add_to_cart.php"
                        ?>
                        <div class="discount">
                            <p class="discount-text">
                                <?= $row["promotion"]?>
                            </p>
                        </div>

                        <a href='details.php?id=<?=urlencode($row["id"])?>&table=serums'>

                        <img src="<?= $row["photo"]?>" alt="" />
                        <div class="product-info">
                            <p class="product-title">
                                <?= $row["name"]?>
                            </p>
                            <p class="product-price"> <?= preg_replace('/[^0-9.]/', '', $row["prix"]) . " MAD" ?></p>
                        </div>
                        </a>
                    </div>


            <?php endwhile; ?>
        <?php else : ?>
            "Aucun produit trouvé.";

        <?php endif; ?>
    </div>
</main>
<?php require_once "utilities/footer.php"?>

<script src="../scripts/recherche.js"></script>
<script src="../scripts/filter.js"></script>
</body>
</html>
