<?php
session_start();
require '../Connect.php';
require 'cart_after_login.php';

$data = json_decode(file_get_contents("php://input"), true);
$db = new Connect();
$conn = $db->conn;

// Handle deletion if 'deleted_item' is sent
if (isset($data['deleted_item'])) {
    // Access category and product_id from deleted_item object
    $category = mysqli_real_escape_string($conn, $data['deleted_item']['category']);
    $product_id = (int)$data['deleted_item']['product_id'];
    $cart_id = $_SESSION['cart_id'] ?? 0;

    // Delete from DB: you need to identify by cart_id, product_id, category
    $delete_sql = "DELETE FROM cart_items WHERE cart_id = $cart_id AND product_id = $product_id AND category = '$category'";
    if (mysqli_query($conn, $delete_sql)) {
        echo "Item deleted successfully";
    } else {
        echo "Failed to delete item: " . mysqli_error($conn);
    }

    // Also remove from session cart
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] === $product_id && $item['category'] === $category) {
                unset($_SESSION['cart'][$key]);
                // reindex array keys
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;
            }
        }
    }
    exit; // stop after deletion since no cart update sent
}

// Handle cart update if 'cart' is sent
if (isset($data["cart"])) {
    $_SESSION["cart"] = [];

    foreach ($data["cart"] as $item) {
        $found = false;

        foreach ($_SESSION["cart"] as &$session_item) {
            if (
                $session_item["product_id"] === $item["productID"] &&
                $session_item["category"] === $item["tableName"]
            ) {
                // if already exists, update quantity
                $session_item["quantity"] = $item["quantity"];
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
    push_cart_items($conn);

} else {
    echo "❌ no cart data received";
}
