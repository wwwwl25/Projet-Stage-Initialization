<?php
require_once '../Connect.php';

$connect = new Connect();
$db = $connect->conn;

$sql = "SELECT id, name, description, prix, photo FROM maquillage";
$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maquillage</title>
    <link rel="stylesheet" href="../styles/product.css">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/boutique.css">
</head>
<body>
<?php require_once "utilities/nav-bar.php"?>
<main>
    <div class="text">
        <h1>Maquillage</h1>
    </div>
    <div class="search-input">
        <input type="text" id="searchInput" placeholder="Rechercher un produit" style="padding: 10px; width: 300px; font-size: 16px;">
    </div>
    <div class="products-container" >
        <?php  if (mysqli_num_rows($result) > 0) : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="product-card">
                        <button class="add-to-cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                        <a href='details.php?id=<?=urlencode($row["id"])?>&table=maquillage'>

                        <img src="<?= $row["photo"]?>" alt="" />
                        <div class="product-info">
                            <p class="product-title">
                                <?= $row["name"]?>
                            </p>
                            <p class="product-price"> <?= preg_replace('/[^0-9]/', '',$row["prix"]) . "MAD"?></p>
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
</body>
</html>
