<?php
session_start();
require "../Connect.php";
if(!isset($_SESSION['checkout_success']) || $_SESSION['checkout_success'] != "SUCCESS"){
    header("Location: /Projet-Stage-Initialization/");
    exit();
}$db = new Connect();
$conn = $db->conn;
$c_id  = (int)$_SESSION['cart_id'];

if (isset($_SESSION['commandes']) && is_array($_SESSION['commandes'])) {
    foreach ($_SESSION["commandes"] as $c) {
        foreach ($_SESSION["cart"] as $key => $i){
            if($c == $i){
                unset($_SESSION["cart"][$key]);
            }
        }
        $p_id = (int)$c["product_id"];
        $categ = mysqli_real_escape_string($conn, $c["category"]);

        $sql = "DELETE FROM cart_items WHERE cart_id = $c_id AND product_id = $p_id AND category = '$categ'";
        mysqli_query($conn, $sql);
    }

}


unset($_SESSION['commandes']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout Success</title>
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/checkout_success.css">
    <link rel="stylesheet" href="../styles/cart.css">

    <!-- Scripts JS -->
</head>
<body>
<?php require_once 'utilities/nav-bar.php'?>

<div class="success-container">
    <h1><i class="fa-solid  fa-square-check"></i> Commande réussie !</h1>
    <p>Merci pour votre achat. Vous recevrez un e-mail de confirmation sous peu.</p>
    <p>Vous pouvez suivre votre commande dans la section <strong>Mes commandes</strong>.</p>
    <a href="commandes.php" class="btn">Voir mes commandes</a>
</div>
</body>
</html>
<?php exit();?>