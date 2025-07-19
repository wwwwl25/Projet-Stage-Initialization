<?php

require '../Connect.php';
session_start();
header('Content-Type: application/json');
$db = new Connect();
$conn = $db->conn;

if (isset($_SESSION['user_id'])) {
    if(isset($_SESSION["cart"])){
        $cart_tracker = [];
        foreach ($_SESSION['cart'] as $item){
            $category = mysqli_real_escape_string($conn, $item['category']);
            $id = (int)$item['product_id'];
            $sql = "SELECT * FROM $category WHERE id = $id";
            $result = mysqli_fetch_assoc(mysqli_query($conn,  $sql));
            $cart_tracker["item_$result[id]_$category"] = ["id"=>$result['id'].'_'.$category, 'price'=>$result['prix'],'image'=>$result['photo'],'name'=>$result['name'], 'quantity'=>(int)$item['quantity']];
        }
    }
    echo json_encode([
        "cart" => $_SESSION['cart'] ?? [],
        "cart_tracker" => $cart_tracker ?? []
    ]);
} else {
    echo json_encode([
        "error" => "not_logged_in"
    ]);
}
