document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById("searchInput");

    if (!searchInput) return;

    searchInput.addEventListener("input", function (){

        const filter = searchInput.value.toLowerCase();
        const products = document.querySelectorAll(".product-card");

        Array.from(products).forEach(function (card) { 
            const name = card.querySelector(".product-title").textContent.toLowerCase();
            if (name.includes(filter)) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    });
});