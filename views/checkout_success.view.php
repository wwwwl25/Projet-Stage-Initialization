<?php
session_start();
if(!isset($_SESSION['checkout_success']) || $_SESSION['checkout_success'] != "SUCCESS"){
    header("Location: /Projet-Stage-Initialization/");
    exit();
}
unset($_SESSION['commandes']);
$_SESSION['cart']= array();
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
    <script>
        localStorage.clear();
    </script>
</head>
<body>
<?php require_once 'utilities/nav-bar.php'?>
<div class="success-container">
    <h1><i class="fa-solid  fa-square-check"></i> Commande réussie !</h1>
    <p>Merci pour votre achat. Vous recevrez un e-mail de confirmation sous peu.</p>
    <p>Vous pouvez suivre votre commande dans la section <strong>Mes commandes</strong>.</p>
    <a href="user.php" class="btn">Voir mes commandes</a>
</div>
</body>
</html>