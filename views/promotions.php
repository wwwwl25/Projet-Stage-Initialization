<?php
    require_once '../controllers/promotions.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Promotions</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/product.css">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
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
        <h1>Promotions</h1>
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
            <?php foreach ($promotions as $promotion) : ?>
            <?php foreach ($promotion as $p) : ?>
                <?php $row = $p?>
                <div class="product-card">
                    <?php $cartText = "<i class='fa-solid fa-cart-shopping'></i>";
                    require "utilities/add_to_cart.php"
                    ?>
                    <div class="discount">
                        <p class="discount">
                            <?= $p['promotion'] ?>
                        </p>
                    </div>
                    <a href='details.php?id=<?=urlencode($p["id"])?>&table=serums'>

                        <img src="<?= $p["photo"]?>" alt="" />
                        <div class="product-info">
                            <p class="product-title">
                                <?= $p["name"]?>
                            </p>
                            <p class="product-price"> <?= preg_replace('/[^0-9.]/', '', $p["prix"]) . " MAD" ?></p>
                        </div>
                    </a>
                </div>


           <?php endforeach;?>
           <?php endforeach;?>
    </div>
</main>
<?php require_once "utilities/footer.php"?>

<script src="../scripts/recherche.js"></script>
<script src="../scripts/filter.js"></script>
</body>
</html>
