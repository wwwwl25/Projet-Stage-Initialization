<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["cart"])) {
    // reset cart session before updating
    $_SESSION["cart"] = [];
    var_dump($data['cart']);
    // repopulate with fresh cart_php data
    foreach ($data["cart"] as $item) {
        $_SESSION["cart"][] = [
            "category" => $item["tableName"],
            "product_id" => $item["productID"],
            "quantity" => $item["quantity"],
        ];
    }

} else {
    echo "❌ no cart data received";
}

