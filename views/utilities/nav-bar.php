<nav class="navbar">
    <div class="navbar-container">
        <div class="hamburger" id="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <a href="/Projet-Stage-Initialization/" class="logo">VitamineDyalk</a>
        <div class="nav-links">
            <a href="/Projet-Stage-Initialization/">Accueil</a>
            <a href="#">Boutique</a>
            <a href="#">Vitamines</a>
            <a href="#">Makeup</a>
            <a href="#">Bio</a>
            <a href="#">Serums</a>
            <a href="#">Support</a>
        </div>


        <div class="icons">
            <a href="views/signup_signin.view.php" title="signup/login">
                <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5.121 17.804A4 4 0 016 15.5h12a4 4 0 01.879 2.304M12 11a4 4 0 100-8 4 4 0 000 8z" />
                </svg>
            </a>
            <a href="#" title="shopping cart">
                <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13l-1.5-6M9 21a1 1 0 11-2 0 1 1 0 012 0zm10 0a1 1 0 11-2 0 1 1 0 012 0z" />
                </svg>
            </a>
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
