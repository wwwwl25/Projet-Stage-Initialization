<?php
function check_cart_exist($conn, $user_id){
    $query = "SELECT * FROM carts WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        $cart = mysqli_fetch_assoc($result);
        $_SESSION['cart_id'] = $cart['id'];
        return true;
    }else{
        $sql = "INSERT INTO carts(user_id) VALUES($user_id)";
        mysqli_query($conn, $sql);
        $_SESSION['cart_id'] = mysqli_insert_id($conn);
        return false;
    }
}
function push_cart_items($conn){
    if(isset($_SESSION['cart_id']) && isset($_SESSION['cart'])){
        $cartId = $_SESSION['cart_id'];
        $sql1 = "SELECT * FROM cart_items WHERE cart_id = $cartId";
        $result = mysqli_query($conn, $sql1);
        $items  =  mysqli_fetch_all($result);
        foreach($_SESSION['cart'] as $item){
            $productID = (int)$item['product_id'];
            $qty = (int)$item['quantity'];
            $ctg = "'" . mysqli_real_escape_string($conn, $item['category']) . "'";
            try {
              foreach($items as $i){

              }
                $sql = "INSERT INTO cart_items(cart_id, product_id, quantity, category) VALUES($cartId, $productID, $qty, $ctg)";
                mysqli_query($conn, $sql);
            }catch(mysqli_sql_exception $e){
                    echo "COULDNT INSERT CART ITEM : $e";
            }
        }
    }else{
        echo 'Cart_id and Cart aint DEFINED in session cuz';
    }
}