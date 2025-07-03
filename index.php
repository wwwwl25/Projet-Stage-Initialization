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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">

</head>
<body>
    <?php require 'views/utilities/nav-bar.php' ?>
    <main class="main-content">
        <div id="image-slider" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <img src="images/priorin.jpg" />
                        <div class="slide-text"> <span class="highlight-text">Stronger hair, naturally.</span>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <img src=images/banner-vitamine.jpg />
                        <div class="slide-text"> <span class="highlight-text">Energy. Immunity. Focus.</span></div>
                    </li>
                    <li class="splide__slide">
                        <img src="images/banner-the-ordinary.jpg" />
                        <div class="slide-text"> <span class="highlight-text">Glow without compromise.</span></div>
                    </li>
                </ul>
            </div>
        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>

    <script src="scripts/home.js"></script>

</body>
</html>