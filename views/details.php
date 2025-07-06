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
</head>
<body>

<h1><?php echo htmlspecialchars($product["name"]); ?></h1>
<img src="<?php echo htmlspecialchars($product["photo"]); ?>" alt="Image" width="300">
<p><strong>Description :</strong> <?php echo htmlspecialchars($product["description"]); ?></p>
<p><strong>Prix :</strong> <?php echo htmlspecialchars($product["prix"]); ?> €</p>

<a href="../index.php">Retour aux produits</a>

</body>
</html>
