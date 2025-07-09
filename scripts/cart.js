document.addEventListener("DOMContentLoaded", function () {
    const cart = document.querySelector(".cart");
    const open_cart   = document.querySelector(".cart-btn");
    const close_cart = document.querySelector(".fa-close");
    close_cart.addEventListener("click", e=>{
        cart.style.display = "none";
    })
    open_cart.addEventListener("click", e=>{
        cart.style.display = "block";
    })});