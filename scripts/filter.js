document.addEventListener("DOMContentLoaded", () => {
  const sortSelect = document.getElementById("sortSelect");
  const container = document.querySelector(".products-container");

  sortSelect.addEventListener("change", () => {
    const cards = Array.from(container.querySelectorAll(".product-card"));

    cards.sort((a, b) => {
      // Njibo les prix sans "MAD" w n7awlohom l float
      const priceA = parseFloat(
        a.querySelector(".product-price").textContent.replace("MAD", "").trim()
      );
      const priceB = parseFloat(
        b.querySelector(".product-price").textContent.replace("MAD", "").trim()
      );

      // Tri selon l'option
      if (sortSelect.value === "asc") {
        return priceA - priceB;
      } else if (sortSelect.value === "desc") {
        return priceB - priceA;
      } else {
        return 0;
      }
    });

    // N3awd display
    container.innerHTML = "";
    cards.forEach((card) => container.appendChild(card));
  });
});
