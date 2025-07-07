<?php
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

$sql = "SELECT name, description, prix, photo FROM $table WHERE id = $id";
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
    <link rel="stylesheet" href="../styles/details.css">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
</head>
<body>
<?php require_once "utilities/nav-bar.php"?>

<div class="product-detail">
    <div class="image-section">
        <img src="<?php echo htmlspecialchars($product["photo"]); ?>" alt="Image produit">
    </div>
    <div class="info-section">
        <h1><?php echo htmlspecialchars($product["name"]); ?></h1>
        <p class="price"><?php echo htmlspecialchars($product["prix"]); ?> €</p>
        <p class="description"><?php echo htmlspecialchars($product["description"]); ?></p>
        <button class="add-to-cart">Ajouter au panier</button>
        <br><br>
        <a href="../index.php" class="back-link">Retour aux produits</a>
    </div>
</div>
<?php require_once "utilities/footer.php"?>

</body>
</html>
