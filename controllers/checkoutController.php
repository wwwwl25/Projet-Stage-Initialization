<?php
session_start();
require "../Connect.php";
$db = new Connect();
$conn = $db->conn;
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_checkout']) && isset($_SESSION["commandes"])){
    if(!isset($_POST['payement_method']) || !isset($_POST['terms']) ){
        $_SESSION['checkout_error'] = "You need to tick the boxes";
        header("Location: /Projet-Stage-Initialization/views/checkout.php");
        exit();
    }
    if(!isset($_POST['nom']) || !isset($_POST['prenom']) ||!isset($_POST['ville']) || !isset($_POST['telephone']) || !isset($_POST['email'])){
            $_SESSION['checkout_info_filling'] = "Please fill out all of the fields with the star *";
            header("Location: /Projet-Stage-Initialization/views/checkout.php");
            exit();
    }
    $commandes = $_SESSION['commandes'];
    $userID = $_SESSION['user_id'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $ville = $_POST['ville'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $notes = $_POST['notes'];
    $payement_method = $_POST['payement_method'];
    foreach ($commandes as $cmd) {
        $ctg = mysqli_real_escape_string($conn, $cmd['category']);
        $pId = (int)$cmd['product_id'];
        $qty = (int)$cmd['quantity'];
        $address = mysqli_real_escape_string($conn, $_POST['adresse'] . "--" . $_POST['ville']);

        try {
            $sql = "INSERT INTO commandes (
    user_id, category, product_id, quantity, address,
    prenom, nom, ville, telephone, email, notes, payment_method, created_at
) VALUES (
    $userID, '$ctg', $pId, $qty, '$address',
    '$prenom', '$nom', '$ville', '$telephone', '$email', '$notes', '$payement_method', NOW()
)";
            mysqli_query($conn, $sql);
        } catch (mysqli_sql_exception $e) {
            echo "Could NOT insert 'la commande' into 'commandes' table here is the full error :\n $e";
        }
    }
    $_SESSION['checkout_success'] = 'SUCCESS';
    header("Location: /Projet-Stage-Initialization/views/checkout_success.view.php");
    exit();
}else{
    $_SESSION['checkout_success'] = 'FAILURE';
    $_SESSION['checkout_error'] = "Something went wrong try again later !";
    header("Location: /Projet-Stage-Initialization/views/checkout.php");
    exit();
}