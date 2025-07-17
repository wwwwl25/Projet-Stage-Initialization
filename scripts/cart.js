document.addEventListener("DOMContentLoaded", function () {
    const cart = document.querySelector(".cart");
    const open_cart   = document.querySelector(".cart-btn");
    const close_cart = document.querySelector(".fa-close");
    if(close_cart){
    close_cart.addEventListener("click", e=>{
        cart.style.display = "none";
    })
    }
    if(open_cart){
    open_cart.addEventListener("click", e=>{
        if(window.location.href.includes("Projet-Stage-Initialization/views/panier.php")){
            window.location = 'http://localhost/Projet-Stage-Initialization/views/panier.php';
        }
        cart.style.display = "block";

    })}
    });