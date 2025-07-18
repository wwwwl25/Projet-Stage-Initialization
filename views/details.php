<?php
session_start();

require_once '../Connect.php';

if (!isset($_GET['id']) || !isset($_GET['table'])) {
    die("Produit introuvable.");
}

$connect = new Connect();
$db = $connect->conn;

$id = intval($_GET['id']);
$table = $_GET['table'];
if (!in_array($table, ['serums', 'vitamines','bio','maquillage'])) {
    die("Table invalide.");
}
$t = $table;
$sql = "SELECT * FROM $table WHERE id = $id";
$result = mysqli_query($db, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    die("Produit non trouvé.");
}

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du produit</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/details.css">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/cart.css">
    <script src="../scripts/cart.js" defer></script>
    <script src="../scripts/add_to_cart.js" defer></script>
</head>
<body>
<?php require_once "utilities/nav-bar.php"?>
<?php require_once "utilities/cart.php"?>
<main>
<div class="product-detail">
    <div class="image-section">
        <img src="<?php echo htmlspecialchars($product["photo"]); ?>" alt="Image produit">
    </div>
    <div class="info-section">
        <h1><?php echo htmlspecialchars($product["name"]); ?></h1>
        <p class="price"><?php echo htmlspecialchars(preg_replace('/[^0-9.]/', '',$product["prix"]) . "MAD"); ?>
            <span class="details-discount">
                <?= $product["promotion"]?>
            </span>
        </p>

        <p class="description"><?php echo htmlspecialchars($product["description"]); ?></p>
        <?php $row = $product; $cartText = "Ajouter au panier";
        require "utilities/add_to_cart.php"
        ?>
        <br><br>
        <a href="../index.php" class="back-link">Retour aux produits</a>
    </div>
</div>
</main>
<?php require_once "utilities/footer.php"?>

</body>
</html>
