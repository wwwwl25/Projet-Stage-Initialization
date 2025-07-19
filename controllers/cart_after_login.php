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
function get_items_from_db($conn, $cond){
    if($cond){
        $sql = "SELECT category, product_id, quantity FROM cart_items WHERE cart_id = '{$_SESSION['cart_id']}'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($rows as $row) {
                $found = false;
                foreach($_SESSION['cart'] as &$item){
                    if($row['category'] == $item['category'] && $row['product_id'] == $item['product_id']){
                        $found = true;
                        if($row['quantity'] != $item['quantity']){
                            $item['quantity'] += $row['quantity'];
                        }
                        break; // found match, no need to continue loop
                    }
                }
                if(!$found){
                    $_SESSION['cart'][] = $row;
                }
            }
        }
    }
}

function push_cart_items($conn){
    if(isset($_SESSION['cart_id']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
        $cartId = $_SESSION['cart_id'];

        // fetch existing cart items for this cart
        $sql1 = "SELECT * FROM cart_items WHERE cart_id = $cartId";
        $result = mysqli_query($conn, $sql1);
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);

        foreach($_SESSION['cart'] as $item){
            $productID = (int)$item['product_id'];
            $qty = (int)$item['quantity'];
            $category = mysqli_real_escape_string($conn, $item['category']);

            $found = false;

            foreach($items as $dbItem){
                if($productID == $dbItem['product_id'] && $category == $dbItem['category']){
                    $found = true;
                    if($qty != (int)$dbItem['quantity']){
                        $sqlUpdate = "UPDATE cart_items SET quantity = $qty 
                                      WHERE cart_id = $cartId AND product_id = $productID AND category = '$category'";
                        mysqli_query($conn, $sqlUpdate);
                    }
                    break;
                }
            }

            if(!$found){
                $sqlInsert = "INSERT INTO cart_items(cart_id, product_id, quantity, category)
                              VALUES($cartId, $productID, $qty, '$category')";
                mysqli_query($conn, $sqlInsert);
            }
        }
    }else{
        echo 'Cart_id and Cart are not defined in session';
    }
}
