<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["cart"])) {
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    foreach ($data["cart"] as $item) {
        $found = false;

        foreach ($_SESSION["cart"] as &$session_item) {
            if (
                $session_item["product_id"] === $item["productID"] &&
                $session_item["category"] === $item["tableName"]
            ) {
                // if already exists, update quantity
                $session_item["quantity"] += $item["quantity"];
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION["cart"][] = [
                "category" => $item["tableName"],
                "product_id" => $item["productID"],
                "quantity" => $item["quantity"],
            ];
        }
    }

    var_dump($_SESSION["cart"]);
} else {
    echo "❌ no cart data received";
}
