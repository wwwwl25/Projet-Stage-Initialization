<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="styles/nav-bar.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/footer.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require 'views/utilities/nav-bar.php' ?>
    <main class="main-content">
        <section id="image-slider" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <img src="images/priorin.jpg" />
                        <div class="slide-text priorin">
                            <h2>Priorin</h2>
                            <span class="highlight-text">Stronger hair, naturally.</span>
                            <a href="#">Achetez</a>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <img src=images/banner-vitamine.jpg />
                        <div class="slide-text vitamines">
                            <h2>Boost your immune system</h2>
                            <span class="highlight-text">Vitamine E, Calcium and more</span>
                            <a href="#">Achetez</a>

                        </div>
                    </li>
                    <li class="splide__slide ordinary">
                        <img src="images/banner-the-ordinary.jpg" />
                        <div class="slide-text"> <span class="highlight-text">The Ordinary.</span></div>
                    </li>
                </ul>
            </div>
        </section>
        <section class="category-section">
            <div class="category-card" style="background-image: url('images/produit-bio.jpg');">
                <div class="card-content">
                    <p class="category-label">PRODUIT BIO</p>
                    <h3>BIO</h3>
                    <p class="category-desc">Crème, Maquillage, Soin et autres.</p>
                    <a href="#" class="discover-btn">Découvrir</a>
                </div>
            </div>
            <div class="category-card" style="background-image: url('images/banner-vitamine.jpg');">
                <div class="card-content">
                    <p class="category-label">COMPLEMENT ALIMENTAIRE</p>
                    <h3>Vitamnes</h3>
                    <p class="category-desc">Viatmine A, Viatmine C, Viatmine D</p>
                    <a href="#" class="discover-btn">Découvrir</a>
                </div>
            </div>    <div class="category-card" style="background-image: url('images/serums.jpg');">
                <div class="card-content">
                    <p class="category-label">Soin</p>
                    <h3>Serums</h3>
                    <p class="category-desc">Soin visage et peau.</p>
                    <a href="#" class="discover-btn">Découvrir</a>
                </div>
            </div>
            <div class="category-card" style="background-image: url('images/makeup.jpg');">
                <div class="card-content">
                    <p class="category-label">MAQUILLAGE</p>
                    <h3>Makeup</h3>
                    <p class="category-desc">Produits pour le visage, les yeux et les lèvres.</p>
                    <a href="#" class="discover-btn">Découvrir</a>
                </div>
            </div>

        </section>
        <section class="prodcuts-preview">
            <h1>Some of our products</h1>
            <div class="product">Product  1 : Waiting ...</div>
            <div class="product">Productr 2 :  Waiting ...</div>
        </section>
        <section class="about">
            <h1>Votre boutique en ligne préférée au Maroc</h1>
            <h2>Services et avantages</h2>
            <div class="features">
                <div class="feature">
                    <i class="fa-solid fa-truck-fast"></i>
                    <h3>Livraison Gratuite</h3>
                    <p>
                        Livraison gratuite pour toute commande de plus de 800 Dhs.
                    </p>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-check"></i>
                    <h3>Authenticité</h3>
                    <p>
                        Nous sommes très exigent concernant l’origine et l’authenticité de tous nos produits.
                    </p>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-gift"></i>
                    <h3>Cadeaux</h3>
                    <p>
                        Pour toute commande sur notre site, vous recevez au moins un petit cadeau.
                    </p>
                </div>
                <div class="feature">
                    <i class="fa-solid fa-headset"></i>
                    <h3>Support 24/7</h3>
                    <p>
                        Vous pouvez nous contacter à tout moment, par mail, sur whatsapp ou sur nos réseaux sociaux.                    </p>
                </div>
            </div>
        </section>
        <section class="best-seller">
            <h1>Best Sellers</h1>
            <div class="product">Product  1 : Waiting ...</div>
            <div class="product">Productr 2 :  Waiting ...</div><div class="product">Product  1 : Waiting ...</div>
            <div class="product">Productr 2 :  Waiting ...</div><div class="product">Product  1 : Waiting ...</div>
            <div class="product">Productr 2 :  Waiting ...</div><div class="product">Product  1 : Waiting ...</div>
            <div class="product">Productr 2 :  Waiting ...</div>
        </section>
        <section class="promotion">
            <p>Jusqu’à -30%</p>
            <h1>Promotions</h1>
            <a href="#">Voir tout</a>
        </section>
    </main>
    <?php require 'views/utilities/footer.php'?>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>

    <script src="scripts/home.js"></script>

</body>
</html>