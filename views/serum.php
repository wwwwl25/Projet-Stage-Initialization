<?php
require_once '../Connect.php';

$connect = new Connect();
$db = $connect->conn;

$sql = "SELECT id, name, description, prix, photo FROM serums";
$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits</title>
    <link rel="stylesheet" href="../styles/produit.css">
</head>
<body>

<h1>Nos Produits</h1>
<div style="text-align: center; margin-bottom: 20px;">
    <input type="text" id="searchInput" placeholder="Rechercher un produit" style="padding: 10px; width: 300px; font-size: 16px;">
</div>
<div class="grid-container">
<?php
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='product-card'>";
        echo "<img src='" . htmlspecialchars($row["photo"]) . "' alt='Image'>";
        echo "<div class='product-name'>" . htmlspecialchars($row["name"]) . "</div>";
        echo "<div class='product-price'>" . htmlspecialchars($row["prix"]) . "€</div>";
    echo "<a href='details.php?id=" . urlencode($row["id"]) . "&table=serums' class='buy-button'>🛒 Acheter</a>";


        echo "</div>";
    }
} else {
    echo "Aucun produit trouvé.";
}
?>
</div>
 <script src="../scripts/recherche.js"></script>
</body>
</html>
