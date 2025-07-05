<?php
require_once '../Connect.php';

// Connexion à la base de données
$connect = new Connect();
$db = $connect->conn;

// Requête SQL
$sql = "SELECT name, description, prix, photo FROM vitamines";
$result = mysqli_query($db, $sql);

// Vérification des erreurs de requête
if (!$result) {
    die("Erreur dans la requête SQL : " . mysqli_error($db));
}
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
    echo "<img src='" . htmlspecialchars($row["photo"]) . "' alt='Image du produit'>";
    echo "<div class='product-name'>" . htmlspecialchars($row["name"]) . "</div>";
    echo "<div class='product-description'>" . htmlspecialchars($row["description"]) . "</div>";
    echo "<div class='product-price'>" . htmlspecialchars($row["prix"]) . "€</div>";
    echo "<form action='commande.php' method='POST' class='buy-form'>";
    echo "<input type='hidden' name='product-name' value='" . htmlspecialchars($row["name"]) . "'>";
    echo "<input type='hidden' name='product-price' value='" . htmlspecialchars($row["prix"]) . "'>";
   echo "<button type='submit' class='buy-button'>🛒 Acheter</button>";
    echo "</form>";
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