<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["myArray"])) {
    // reset cart session before updating
    $_SESSION["cart"] = [];

    // repopulate with fresh cart_php data
    foreach ($data["myArray"] as $item) {
        $_SESSION["cart"][] = [
            "tableName" => $item["tableName"],
            "productID" => $item["productID"]
        ];
    }

} else {
    echo "❌ no cart data received";
}
