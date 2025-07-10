<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../styles/faq.css">   
    <link rel="stylesheet" href="../styles/product.css">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/boutique.css">
</head>
<body>
    <?php require_once "utilities/nav-bar.php"?>

  <div class="container">
    <h1>FAQ's - jtr_shop</h1>

    <div class="faq-item">
      <input type="checkbox" id="q1" />
      <label for="q1">Comment puis-je passer une commande ?</label>
      <div class="faq-answer">
        Pour passer une commande, sélectionnez les produits que vous souhaitez acheter, ajoutez-les à votre panier, puis suivez les instructions de paiement à la caisse.
      </div>
    </div>

    <div class="faq-item">
      <input type="checkbox" id="q2" />
      <label for="q2">Quels sont les modes de paiement acceptés ?</label>
      <div class="faq-answer">
        Nous acceptons les paiements par carte bancaire, PayPal, et virement bancaire.
      </div>
    </div>

    <div class="faq-item">
      <input type="checkbox" id="q3" />
      <label for="q3">Comment suivre ma commande ?</label>
      <div class="faq-answer">
        Une fois votre commande expédiée, vous recevrez un email avec un numéro de suivi pour suivre la livraison.
      </div>
    </div>

    <div class="faq-item">
      <input type="checkbox" id="q4" />
      <label for="q4">Quelle est votre politique de retour ?</label>
      <div class="faq-answer">
        Vous pouvez retourner un produit dans un délai de 14 jours après réception, à condition qu'il soit dans son état d'origine.
      </div>
    </div>

    <div class="faq-item">
      <input type="checkbox" id="q5" />
      <label for="q5">Proposez-vous la livraison internationale ?</label>
      <div class="faq-answer">
        Oui, nous livrons dans plusieurs pays, les frais et délais varient selon la destination.
      </div>
    </div>

    <div class="faq-item">
      <input type="checkbox" id="q6" />
      <label for="q6">Puis-je modifier ma commande après l'avoir passée ?</label>
      <div class="faq-answer">
        Les modifications sont possibles uniquement avant la confirmation de l'expédition. Contactez-nous rapidement pour toute demande.
      </div>
    </div>

    <div class="faq-item">
      <input type="checkbox" id="q7" />
      <label for="q7">Comment puis-je contacter le service client ?</label>
      <div class="faq-answer">
        Vous pouvez nous contacter via notre formulaire en ligne, par email ou par téléphone aux horaires indiqués sur notre site.
      </div>
    </div>


  </div>
<?php require_once "utilities/footer.php"?>
</body>
</html>
