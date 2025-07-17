<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<nav class="navbar">
    <div class="navbar-container">
        <div class="hamburger" id="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <a href="/Projet-Stage-Initialization/" class="logo">
            JTR<i class="fa-solid fa-leaf"></i>SHOP
        </a>
        <div class="nav-links">

            <a href="/Projet-Stage-Initialization/" class="<?php echo $_SERVER['REQUEST_URI'] == "/Projet-Stage-Initialization/" ? 'active' : ''?>">Accueil</a>
            <a href="/Projet-Stage-Initialization/views/vitamine.php" class="<?php echo $_SERVER['REQUEST_URI'] == "/Projet-Stage-Initialization/views/vitamine.php" ? 'active' : ''?>">Vitamines</a>
            <a href="/Projet-Stage-Initialization/views/maquillage.php" class="<?php echo $_SERVER['REQUEST_URI'] == "/Projet-Stage-Initialization/views/maquillage.php" ? 'active' : ''?>">Makeup</a>
            <a href="/Projet-Stage-Initialization/views/produit-bio.php" class="<?php echo $_SERVER['REQUEST_URI'] == "/Projet-Stage-Initialization/views/produit-bio.php" ? 'active' : ''?>">Bio</a>
            <a href="/Projet-Stage-Initialization/views/serum.php" class="<?php echo $_SERVER['REQUEST_URI'] == "/Projet-Stage-Initialization/views/serum.php" ? 'active' : ''?>">Serums</a>
            <a href="/Projet-Stage-Initialization/views/promotions.php" class="<?php echo $_SERVER['REQUEST_URI'] == "/Projet-Stage-Initialization/views/promotions.php" ? 'active' : ''?>">Promotions</a>
        </div>


        <div class="icons">
            <a class="login-btn" style="margin-top: 0.5em" href="<?php echo isset($_SESSION['user_name']) && isset($_SESSION['user_email']) ? '/Projet-Stage-Initialization/views/user.php' : '/Projet-Stage-Initialization/views/signup_signin.view.php'; ?>" title="signup/login">
            <?php if(isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) : ?>
                <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5.121 17.804A4 4 0 016 15.5h12a4 4 0 01.879 2.304M12 11a4 4 0 100-8 4 4 0 000 8z" />
                </svg>
                <?php else:?>
                <i class="fa-solid fa-arrow-right-to-bracket" style="font-size: 1.5em; margin-bottom: 0.5em"></i>

            <?php endif;?>
            </a>
            <div title="shopping cart" class="cart-btn">
                <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13l-1.5-6M9 21a1 1 0 11-2 0 1 1 0 012 0zm10 0a1 1 0 11-2 0 1 1 0 012 0z" />
                </svg>   <sup>1</sup>
            </div>
        </div>

    </div>


</nav>

<script>
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.querySelector('.nav-links');

    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('open');
    });

</script>
