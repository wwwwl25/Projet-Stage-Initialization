<?php
require_once '../../Connect.php';
$db = new Connect();

$allowedTables = ['bio', 'vitamines', 'serums', 'maquillage'];
$table = isset($_GET['table']) && in_array($_GET['table'], $allowedTables) ? $_GET['table'] : 'bio';

// Suppression directe sans confirmation JS
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    $db->conn->query("DELETE FROM $table WHERE id = $id");
    header("Location: admin.php?table=$table");
    exit;
}

// Ajout ou modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $db->conn->real_escape_string($_POST['name']);
    $description = $db->conn->real_escape_string($_POST['description']);
    $price = floatval($_POST['price']);
    $photo = $db->conn->real_escape_string($_POST['photo']); // supposons URL ou nom de fichier en string

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = intval($_POST['id']);
        $db->conn->query("UPDATE $table SET name='$name', description='$description', prix=$price, photo='$photo' WHERE id=$id");
    } else {
        $db->conn->query("INSERT INTO $table (name, description, prix, photo) VALUES ('$name', '$description', $price, '$photo')");
    }
    header("Location: admin.php?table=$table");
    exit;
}

// Pour modification
$productToEdit = null;
if (isset($_GET['edit_id'])) {
    $id = intval($_GET['edit_id']);
    $result = $db->conn->query("SELECT * FROM $table WHERE id=$id");
    if ($result && $result->num_rows > 0) {
        $productToEdit = $result->fetch_assoc();
    }
}

// Tous les produits
$products = $db->conn->query("SELECT * FROM $table");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panneau Admin</title>
      <link rel="stylesheet" href="/Projet-Stage-Initialization/styles/nav-bar.css">
    <link rel="stylesheet" href="/Projet-Stage-Initialization/styles/product.css">
    <link rel="stylesheet" href="/Projet-Stage-Initialization/styles/nav-bar.css">
    <link rel="stylesheet" href="/Projet-Stage-Initialization/styles/footer.css">
    <link rel="stylesheet" href="/Projet-Stage-Initialization/styles/boutique.css">
    <link rel="stylesheet" href="/Projet-Stage-Initialization/styles/admin.css">
</head>
<body>
<?php require_once "../utilities/nav-bar.php" ?>
<h1>Panneau d'administration - <?= ucfirst($table) ?></h1>

<!-- Choix de la table -->
<form method="get" action="admin.php" class="category-form" >
    <label for="table"  >Choisir une catégorie :</label>
    <select name="table" id="table" onchange="this.form.submit()">
        <?php foreach ($allowedTables as $t): ?>
            <option value="<?= $t ?>" <?= $t == $table ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
        <?php endforeach; ?>
    </select>
</form>


<!-- Tableau des produits -->
<?php if ($products && $products->num_rows > 0): ?>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th><th>Nom</th><th>Description</th><th>Prix</th><th>Photo</th><th>Actions</th>
    </tr>
    <?php while ($row = $products->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td><?= number_format($row['prix'], 2) ?> MAD</td>
        <td>
            <?php if (!empty($row['photo'])): ?>
                <img src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo" style="max-width:80px; max-height:80px;">
            <?php else: ?>
                N/A
            <?php endif; ?>
        </td>
        <td>
            <a href="admin.php?table=<?= $table ?>&edit_id=<?= $row['id'] ?>">Modifier</a> |
            <a href="admin.php?table=<?= $table ?>&delete_id=<?= $row['id'] ?>">Supprimer</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
<p>Aucun produit trouvé dans cette catégorie.</p>
<?php endif; ?>

<hr>

<!-- Formulaire Ajout/Modification -->
<h2><?= $productToEdit ? "Modifier le produit" : "Ajouter un nouveau produit" ?></h2>

<form method="post" action="admin.php?table=<?= $table ?>">
    <input type="hidden" name="id" value="<?= $productToEdit ? $productToEdit['id'] : '' ?>">

    Nom : <br>
    <input type="text" name="name" required value="<?= $productToEdit ? htmlspecialchars($productToEdit['name']) : '' ?>"><br><br>

    Description : <br>
    <textarea name="description" rows="4" cols="50" required><?= $productToEdit ? htmlspecialchars($productToEdit['description']) : '' ?></textarea><br><br>

    Prix : <br>
    <input type="number" step="0.01" name="price" required value="<?= $productToEdit ? $productToEdit['prix'] : '' ?>"><br><br>

    Photo (URL ou chemin) : <br>
    <input type="text" name="photo" value="<?= $productToEdit ? htmlspecialchars($productToEdit['photo']) : '' ?>"><br><br>

    <button type="submit"><?= $productToEdit ? "Mettre à jour" : "Ajouter" ?></button>
</form>

<?php require_once "../utilities/footer.php" ?>
</body>
</html>