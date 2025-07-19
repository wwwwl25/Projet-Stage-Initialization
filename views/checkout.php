<?php
session_start();

if (!isset($_SESSION["user_email"])) {
    $previous = $_SERVER['HTTP_REFERER'] ?? 'index.php'; // fallback if referrer is not set
    $_SESSION["denied"] = "You need an account to head to the checkout page.";
    header("Location: $previous");
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <link rel="stylesheet" href="../styles/nav-bar.css">

    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/checkout.css">
    <link rel="stylesheet" href="../styles/cart.css">

    <script src="../scripts/cart.js" defer></script>
    <script src="../scripts/add_to_cart.js" defer></script>


</head>
<body>
  <?php require_once "utilities/nav-bar.php" ?>
  <?php require_once "utilities/cart.php" ?>


  <main>
    <div class="flex">
        <a href="/Projet-Stage-Initialization/views/panier.php" class="back-link">&lt; Back to Cart</a>

        <h2>Facturation & Expédition</h2>


    </div>

  <form>
      <div class="form-group">
          <div class="field">
              <label for="prenom">Prénom *</label>
              <input type="text" id="prenom" name="prenom" required>
          </div>
          <div class="field">
              <label for="nom">Nom *</label>
              <input type="text" id="nom" name="nom" required>
          </div>
      </div>

      <div class="form-group">
          <div class="field">
              <label for="adresse">Numéro et nom de rue *</label>
              <input type="text" id="adresse" name="adresse" required>
          </div>
      </div>

      <div class="form-group">
          <div class="field">
              <label for="ville">Ville *</label>
              <select id="ville" name="ville" required>
                  <option value="">Sélectionnez une ville</option>
                  <option value="paris">Paris</option>
                  <option value="lyon">Lyon</option>
                  <option value="marseille">Marseille</option>
              </select>
          </div>
      </div>

      <div class="form-group">
          <div class="field">
              <label for="telephone">Téléphone *</label>
              <input type="tel" id="telephone" name="telephone" required>
          </div>
          <div class="field">
              <label for="email">E-mail *</label>
              <input type="email" id="email" name="email" value="mola91488@gmail.com" required>
          </div>
      </div>

      <div class="section">
          <h2>Informations complémentaires</h2>
          <div class="form-group">
              <div class="field">
                  <label for="notes">Notes de commande (facultatif)</label>
                  <textarea id="notes" name="notes"></textarea>
              </div>
          </div>
      </div>
  </form>


    </main>
  <?php require_once "utilities/footer.php" ?>
</body>

</html>
