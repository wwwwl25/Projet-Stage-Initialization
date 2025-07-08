
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
</head>
<body>
<?php require_once "utilities/nav-bar.php"?>
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

</main>
<?php require_once "utilities/footer.php"?>

<script src="../scripts/recherche.js"></script>
<script src="../scripts/filter.js"></script>
</body>
</html>
