let cart_tracker = JSON.parse(localStorage.getItem("cart_tracker")) || {};
let cart_php = JSON.parse(localStorage.getItem("cart_php")) || [];

const add_to_cart_btns = document.querySelectorAll(".add-to-cart");
const cart = document.querySelector(".cart");
const items_container = document.querySelector(".items-container");
const sous_total = document.querySelector(".sous-total-prix");
const item_count = document.querySelector(".items-counter");
let total_price = 0;
let item_counter = 0;
function saveCartToLocalStorage() {
    localStorage.setItem("cart_tracker", JSON.stringify(cart_tracker));
    localStorage.setItem("cart_php", JSON.stringify(cart_php));
}
document.addEventListener("DOMContentLoaded", () => {
    add_item_cartDOM();

});


function showCart(){
    cart.style.display = "block";
}
function updateCounters(){
    total_price = 0;
    item_counter = 0;
    for(key in cart_tracker) {
        const item = cart_tracker[key];
        total_price += Number(item["price"]);
        item_counter += Number(item["quantity"]);
    }
    sous_total.textContent = total_price.toFixed(2);
    item_count.textContent = item_counter;
}
function add_item(e){
    const current_item = e.currentTarget;
    const price = current_item.dataset.price;
    const image = current_item.dataset.photo;
    const name = current_item.dataset.title;
    const table = current_item.dataset.table;
    const productId = String(current_item.dataset.productId);
    cart_tracker[`item_${productId}`] = {'id':productId,'price': price, 'image': image, 'name': name, 'quantity': 1};
    const exists = cart_php.some(([t, id]) => t === table && id === Number(productId));
    if (!exists) cart_php.push([table, Number(productId)]);
    saveCartToLocalStorage();
    send_to_cartPHP();
    if(!window.location.href.includes("/Projet-Stage-Initialization/views/details")){
        const btns = document.querySelectorAll(`.add-to-cart[data-product-id="${productId}"]`);
        btns.forEach(btn=>{
            btn.classList.add("added_to_cart");
            btn.innerHTML = `<i class="fa-solid fa-square-check"></i>`;
        })

    }

}
function add_item_cartDOM(){
    total_price = 0;
    item_counter = 0;

    items_container.innerHTML = '';
    for(key in cart_tracker) {
        const item = cart_tracker[key];
        const itemElement = `<div class="item" data-product-id ="${String(item['id'])}">
                <img src="${item['image']}" alt="item-image" id="item-image">
                <div class="item-info">
                    <div class="top">
                        <p class="item-title">${item['name']}</p>
                        <i class="fa-solid fa-close item-remove"></i>
                    </div>
                    <div class="bottom">
                        <div class="item-addition">
                           <button class="minus">-</button>
                           <p class="item-quantity">1</p>
                           <button class="plus">+</button>
                        </div>
                        <p class="item-price">
                            <span>${item['price']}</span>MAD
                        </p>
                    </div>
                </div>
            </div>`;
        total_price += Number(item["price"]);
        item_counter += Number(item["quantity"]);
        items_container.innerHTML += itemElement;
    }

    updateCounters();
}

cart.addEventListener("click", e=>{
    if(e.target.classList.contains("item-remove")){

        const parent = e.target.closest(".item");
        const product_id =  parent.dataset.productId;
        delete cart_tracker[`item_${product_id}`];
        cart_php = cart_php.filter(([table, id]) => String(id) !== product_id);
        saveCartToLocalStorage();
        send_to_cartPHP()
        items_container.querySelector(`.item[data-product-id='${product_id}']`).remove();
        const targetBtn = document.querySelectorAll(`.add-to-cart[data-product-id='${product_id}']`);
        targetBtn.forEach(item => {
            if (item) {
                console.log("item exists")
                item.classList.remove("added_to_cart");
                item.innerHTML = `<i class="fa-solid fa-cart-shopping"></i>`;
            }
            else {
                console.warn(`Button not found for product ID: ${product_id}`);
            }
        });

        updateCounters();

    }
})

add_to_cart_btns.forEach(btn =>{
    btn.addEventListener("click", e =>{
        if(!btn.classList.contains("added_to_cart")){
            showCart();
            add_item(e);
            add_item_cartDOM();


        }else{
            window.location.href = "/Projet-Stage-Initialization/views/serum.php"
        }

    });
})
function send_to_cartPHP(){
    const cleaned = cart_php.map(([tableName, productID]) => ({ tableName, productID }));

    fetch("/Projet-Stage-Initialization/controllers/cart.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ myArray: cleaned })
    })
        .then(res => res.text())
        .then(data => console.log(data))
        .catch(err => console.error(err));
}
