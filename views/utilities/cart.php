 <div class="cart">
        <div class="header-text">
            <p>Cart<sup class="items-counter"></sup></p>

            <i class="fa-solid fa-close"></i>
        </div>
     <?php

     if (isset($_SESSION["denied"])) {
         echo "<p style='margin-left:3em;margin-top: -2em; font-size:0.8em;color:indianred;'>{$_SESSION["denied"]}</p>";
         unset($_SESSION["denied"]); // remove it so it doesn’t show again
     }
     ?>
        <div class="items-container">

        </div>
        <div class="cta">
            <div class="sous-total">
                <p>Sous-total :</p>
                <p><span class="sous-total-prix">0</span>MAD</p>
            </div>
            <button class="panier" onclick="window.location = 'http://localhost/Projet-Stage-Initialization/views/panier.php';">Voir le panier</button>
            <a href="/Projet-Stage-Initialization/views/checkout.php" style="width: 100%"><button class="commander">Valider la commande</button></a>
        </div>
    </div>
