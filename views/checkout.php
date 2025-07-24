<?php
session_start();
require '../Connect.php';
$db = new Connect;
$conn = $db->conn;
if (!isset($_SESSION["user_email"]) || empty($_SESSION["cart"])) {
    $previous = $_SERVER['HTTP_REFERER'] ?? 'index.php'; // fallback if referrer is not set
    $_SESSION["denied"] = "You need an account to head to the checkout page.";
    header("Location: $previous");
    exit;
}
$total = 0;
$_SESSION['commandes'] =  [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport"          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/checkout.css">
    <link rel="stylesheet" href="../styles/cart.css">

    <script src="../scripts/cart.js" defer></script>
    <script src="../scripts/add_to_cart.js" defer></script>


</head>
<body>
  <?php require_once "utilities/nav-bar.php" ?>


  <main>
      <div class="left">
    <div class="flex">
        <a href="/Projet-Stage-Initialization/views/panier.php" class="back-link">&lt; Back to Cart</a>

        <h2>Facturation & Expédition</h2>


    </div>

  <form action="../controllers/checkoutController.php" method="POST">
      <div class="form-group">
          <div class="field">
              <label for="prenom">Prénom *</label>
              <input type="text" id="prenom" name="prenom" value="<?= $_SESSION['user_name']?>" required>
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
                  <option value="casablanca">Casablanca</option>
                  <option value="rabat">Rabat</option>
                  <option value="marrakech">Marrakech</option>
                  <option value="fes">Fès</option>
                  <option value="tanger">Tanger</option>
                  <option value="agadir">Agadir</option>
                  <option value="meknes">Meknès</option>
                  <option value="oujda">Oujda</option>
                  <option value="kenitra">Kénitra</option>
                  <option value="tetouan">Tétouan</option>
                  <option value="safi">Safi</option>
                  <option value="el_jadida">El Jadida</option>
                  <option value="berkane">Berkane</option>
                  <option value="beni_mellal">Béni Mellal</option>
                  <option value="taza">Taza</option>
                  <option value="larache">Larache</option>
                  <option value="nador">Nador</option>
                  <option value="khemisset">Khémisset</option>
                  <option value="khouribga">Khouribga</option>
                  <option value="guelmim">Guelmim</option>
                  <option value="taourirt">Taourirt</option>
                  <option value="al_hoceima">Al Hoceïma</option>
                  <option value="azrou">Azrou</option>
                  <option value="ifrane">Ifrane</option>
                  <option value="errachidia">Errachidia</option>
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
              <input type="email" id="email" name="email" value="<?= $_SESSION['user_email']?>" required>
          </div>
      </div>
        <p style="color: indianred">
            <?php
            if(isset($_SESSION['checkout_info_filling'])){
                echo $_SESSION['checkout_info_filling'];
                unset($_SESSION['checkout_info_filling']);
            }
            ?>
        </p>
      <div class="section">
          <h2>Informations complémentaires</h2>
          <div class="form-group">
              <div class="field">
                  <label for="notes">Notes de commande (facultatif)</label>
                  <textarea id="notes" name="notes"></textarea>
              </div>
          </div>
      </div>
      </div>
      <section class="checkout_paper">
          <h2>Votre commande</h2>
        <div class="commandes-container">
            <?php foreach($_SESSION['cart']  as $item) :?>
            <?php
               $ctg = mysqli_real_escape_string($conn, $item['category']) ;
               $productID= $item['product_id'];

                $sql = "SELECT * FROM $ctg WHERE id = $productID";
                $result = mysqli_fetch_assoc(mysqli_query($conn,$sql));
                $total += $item['quantity'] * $result['prix'];
                $_SESSION['commandes'][] = ["category"=>$ctg, "product_id"=>$productID, "quantity"=>$item['quantity']];
                ?>
                <div class="commande">
                    <img src="<?=$result['photo']?>" alt="<?=$result['description']?>">
                    <p  class="name">
                        <?=$result['name']?>
                        <span class="quantity">x <?=$item['quantity']?></span>
                    </p>
                    <p  class="price"><?=$result['prix']*$item['quantity']?>MAD</p>
                </div>

            <?php endforeach;?>
        </div>
          <hr>
         <div class="totals">
             <p class="sous-total"><span>SOUS TOTAL</span><span><?= $total?> MAD</span>
             <hr>
             <p class="total"><span>TOTAL</span><span><?= $total?> MAD</span></p>
         </div>
              <input type="hidden" name="total" id="total" value="<?=$total?>">
              <input type="hidden" name="sous_total" id="sous_total" value="<?=$total?>">
          <div class="paying-method">
                  <input type="radio"  id="banc" name="payement_method" value="Paiement bancaire" required>
                  <label for="banc">Virement bancaire</label>
                  <p>Veuillez nous contacter sur WhatsApp ou par email si vous souhaitez effectuer un paiement par virement bancaire.</p>
              <hr>
                  <input type="radio" id="face-face" name="payement_method"  value="Paiement a la livraison" required >
                  <label for="face-face">Paiement à la livraison</label>

          </div>
              <div class="checkout_cta">
                  <p>Vos données personnelles seront utilisées pour traiter votre commande, soutenir votre expérience tout au long de ce site web, et à d'autres fins décrites dans notre politique de confidentialité.</p>
                  <input type="checkbox" name="terms" id="terms" required>
                  <label for="terms"> J'ai lu et j'accepte les conditions générales de vente <sup>*</sup></label>
                  <input type="submit" value="Commander" name="submit_checkout" id="submit_checkout">
                  <p style="color: indianred;font-size: 0.8em;margin-top: 0.5em;">
                      <?php
                        if(isset($_SESSION['checkout_error'])){
                            echo $_SESSION['checkout_error'];
                            unset($_SESSION['checkout_error']);
                        }
                      ?>
                  </p>
              </div>
          </form>

      </section>

    </main>
</body>

</html>
