let cart_tracker = {};
const add_to_cart_btns = document.querySelectorAll(".add-to-cart");
const cart = document.querySelector(".cart");
const items_container = document.querySelector(".items-container");
let totalPrice = 0;
function showCart(){
    cart.style.display = "block";
}

function add_item(e){
    const current_item = e.currentTarget;
    const price = current_item.dataset.price;
    const image = current_item.dataset.photo;
    const name = current_item.dataset.title;
    const productId = current_item.dataset.productId;
    cart_tracker[`item_${productId}`] = {'id':productId,'price': price, 'image': image, 'name': name, 'quantity': 1};


    current_item.classList.add("added_to_cart");
    current_item.innerHTML = `<i class="fa-solid fa-square-check"></i>`;

    console.log(cart_tracker);
}
function add_item_cartDOM(){
    for(item in cart_tracker) {
        const item = `<div class="item" data-product-id ="${item['id']}">
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
        items_container.innerHTML += item;
    }
}
cart.addEventListener("click", e=>{
    if(e.target.classList.contains("item-remove")){
        //
        const itemRemove = e.target;
        const product_id =  itemRemove.parentElement.parentElement.parentElement.dataset.productId;
        document.querySelector(`.add-to-cart[data-product-id='${product_id}']`).classList.remove("added_to_cart");
        document.querySelector(`.add-to-cart[data-product-id='${product_id}']`).innerHTML = `<i class="fa-solid fa-cart-shopping"></i>`;
        // itemRemove.parentElement.parentElement.parentElement.remove();

        items_container.querySelector(`.item[data-product-id='${product_id}']`).remove();

    }
})

add_to_cart_btns.forEach(btn =>{
    btn.addEventListener("click", e =>{
        if(!btn.classList.contains("added_to_cart")){
            showCart();
            add_item(e);
        }else{
            window.location.href = "/Projet-Stage-Initialization/views/serum.php"
        }

    });
})







function old(){
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const cart = document.querySelector(".cart");
    const cartItemCounter = document.querySelector(".items-counter");
    const itemsContainer = document.querySelector(".items-container");
    const totalPriceDisplay = document.querySelector(".sous-total-prix");
    let totalPrice = 0;
    let countItems = 0;
    addToCartButtons.forEach(addToCartBtn => {
        addToCartBtn.addEventListener("click", add_item_to_cart);
    });

    function add_item_to_cart(e){
        const addToCartBtn = e.currentTarget;
        countItems++;
        cartItemCounter.textContent = countItems;
        const title = addToCartBtn.dataset.title
        const photo = addToCartBtn.dataset.photo
        const price = Number(addToCartBtn.dataset.price)
        const itemHTML = `
       <div class="item">
                <img src="${photo}" alt="item-image" id="item-image">
                <div class="item-info">
                    <div class="top">
                        <p class="item-title">${title}</p>
                        <i class="fa-solid fa-close item-remove"></i>
                    </div>
                    <div class="bottom">
                        <div class="item-addition">
                           <button class="minus">-</button>
                           <p class="item-quantity">1</p>
                           <button class="plus">+</button>
                        </div>
                        <p class="item-price">
                            <span>${price}</span>MAD
                        </p>
                    </div>
                </div>
            </div>
`;
        itemsContainer.innerHTML += itemHTML;
        totalPrice+= price;
        totalPriceDisplay.textContent = totalPrice.toFixed(2) + 'MAD';
        cart.style.display = "block";

    }

    cart.addEventListener("")

    const quantityBtns = document.querySelectorAll(".item-addition button");

    quantityBtns.forEach(btn=> {
        btn.addEventListener("click", e =>{
            const button = e.currentTarget;
            if(button.classList.contains("minus")){
                console.log("minus")

            }
            if(button.classList.contains("plus")){
                console.log("plus")
                let a = Number(button.parentElement.parentElement.parentElement.parentElement.querySelector(".item-price span").textContent);
                a+=a;
                button.parentElement.parentElement.parentElement.parentElement.querySelector(".item-price span").textContent = a;
                countItems++;
                button.parentElement.parentElement.parentElement.parentElement.querySelector(".item-quantity").textContent = countItems;
                cartItemCounter.textContent = countItems;
                console.log(button.parentElement.parentElement.parentElement.parentElement.querySelector(".item-price span").textContent);

            }


        })
    })

    function stuff(){

        const quantity_buttons = document.querySelectorAll(".item-addition button");
        const quantity_count = document.querySelector(".item-quanity");
        quantity_buttons.forEach(btn => {
                btn.addEventListener("click", e => {
                    const priceDisplay = document.querySelector(`.${e.target.parentElement.className} + .item-price`);
                    if (e.currentTarget.classList.contains("plus")) {
                        q_c++;
                        newPrice += price;
                        console.log(q_c);
                        console.log(price);

                        console.log(newPrice);

                    }

                    if (e.currentTarget.classList.contains("minus") && q_c > 1 && q_c < 100)
                    {
                        q_c--;

                        newPrice-= price;

                    }
                    console.log(newPrice);

                    quantity_count.textContent = q_c;
                    cartItemCounter.textContent = q_c;
                    totalPriceDisplay.textContent = newPrice.toFixed(2) + 'MAD';
                    priceDisplay.textContent = newPrice.toFixed(2) + 'MAD';
                });

            }
        );
    }

}