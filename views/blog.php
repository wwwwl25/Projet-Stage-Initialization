<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Nos Produits & Conseils</title>
  
  <!-- Font Awesome -->

  
  <!-- Tes fichiers CSS -->
  <link rel="stylesheet" href="../styles/nav-bar.css">
  <link rel="stylesheet" href="../styles/product.css">
  <link rel="stylesheet" href="../styles/footer.css">
  <link rel="stylesheet" href="../styles/blog.css">
</head>
<body>

<?php require_once "utilities/nav-bar.php"; ?>

<main>
  <h1>Nos Produits & Conseils</h1>

  <div class="products-grid">

    <div class="product-card">
      <img class="product-image" src="https://www.symbiosys.fr/dw/image/v2/BGGW_PRD/on/demandware.static/-/Sites-SymbiosysFR-Library/default/dwe339192d/Symbiosys%20-%20Bienfaits%20de%20la%20vitamine%20D%20-%20Photo%201%20-%20Desktop.jpeg?sw=375&sfrm=jpg&q=90" alt="Bienfaits de la vitamine D" />
      <div class="product-info">
        <div class="product-name">Tout savoir sur la Vitamine D et ses bienfaits !</div>
        <div class="product-advice">Vitamine D Maroc : Se supplémenter en la vitamine du soleil ! Vous souffrez des maux musculaires ou osseux ? Vous vous sentez épuisés et stressés tout le temps ? Ou bien […]</div>
      </div>
    </div>

    <div class="product-card">
      <img class="product-image" src="https://german-beautyshop.com/wp-content/uploads/2020/12/the-ordinary-maroc-1.jpg" alt="Produits The Ordinary Maroc" />
      <div class="product-info">
        <div class="product-name">The Ordinary Maroc : Guide complet</div>
        <div class="product-advice">Parmi toutes les marques de produits cosmétiques et de soins, rares sont celles qui allient haute qualité et bon prix. La marque The Ordinary en est une qui a fait de permettre à tous un accès aisé à ces prestigieux soins son objectif premier.</div>
      </div>
    </div>

    <div class="product-card">
      <img class="product-image" src="https://german-beautyshop.com/wp-content/uploads/2020/12/chute-des-cheveux--1024x616.jpg" alt="Conseils contre la chute de cheveux" />
      <div class="product-info">
        <div class="product-name">Conseils pour lutter contre la chute de cheveux</div>
        <div class="product-advice">La chute de cheveux, l’alopécie, la calvitie ou encore la pelade sont tous des termes désignant un trouble disgracieux qui touche principalement les hommes et peut résulter en une perte totale ou partielle de la chevelure.</div>
      </div>
    </div>

  </div>
</main>

<?php require_once "utilities/footer.php"; ?>

</body>
</html>
