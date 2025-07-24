<?php
session_start();
require "../Connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer-master/src/Exception.php';
require_once '../PHPMailer-master/src/PHPMailer.php';
require_once '../PHPMailer-master/src/SMTP.php';
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
    try {
        $userMail = new PHPMailer(true);
        $userMail->CharSet = 'UTF-8';
        $userMail->isSMTP();
        $userMail->Host = 'smtp.gmail.com';
        $userMail->SMTPAuth = true;
        $userMail->Username = 'saadiaabdilah@gmail.com';
        $userMail->Password = 'stqp imny ikcw ttyk';
        $userMail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $userMail->Port = 465;

        $userMail->setFrom('saadiaabdilah@gmail.com', 'JTR_Shop');
        $userMail->addAddress($email, "$prenom $nom");
        $userMail->isHTML(true);
        $userMail->Subject = '🧾 Confirmation de votre commande - JTR_Shop';

        // 💬 build HTML table of all commandes
        $orderRows = '';
        $total = 0;
        foreach ($_SESSION['commandes'] as $cmd){
            $ctg = mysqli_real_escape_string($conn, $cmd['category']);
               $pId = (int)$cmd['product_id'];

            $sql = "SELECT name FROM $ctg WHERE id = $pId";
            $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $product = htmlspecialchars($result['name']);
            $qty = (int)$cmd['quantity'];
            $price = (float)$cmd['price'] * $qty;
            $subtotal = $_POST["sous_total"];
            $total = $_POST["total"];

            $orderRows .= "
            <tr>
                <td style='padding:8px;border:1px solid #ccc;'>$product</td>
                <td style='padding:8px;border:1px solid #ccc;text-align:center;'>$qty</td>
                <td style='padding:8px;border:1px solid #ccc;text-align:right;'>$price €</td>
                <td style='padding:8px;border:1px solid #ccc;text-align:right;'>$subtotal €</td>
            </tr>
        ";
        }

        $userMail->Body = "
        <div style='font-family:Arial, sans-serif; color:#333;'>
            <h2 style='color:#27ae60;'>Merci pour votre commande, $prenom !</h2>
            <p>Votre commande a été enregistrée avec succès. Voici le récapitulatif :</p>

            <h3>📦 Détails de la commande</h3>
            <table style='border-collapse:collapse; width:100%; margin-top:10px;'>
                <thead>
                    <tr style='background:#f0f0f0;'>
                        <th style='padding:10px;border:1px solid #ccc;'>Produit</th>
                        <th style='padding:10px;border:1px solid #ccc;'>Quantité</th>
                        <th style='padding:10px;border:1px solid #ccc;'>Prix unitaire</th>
                        <th style='padding:10px;border:1px solid #ccc;'>Total</th>
                    </tr>
                </thead>
                <tbody>
                    $orderRows
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan='3' style='padding:10px;border:1px solid #ccc;text-align:right;'><strong>Total :</strong></td>
                        <td style='padding:10px;border:1px solid #ccc;text-align:right;'><strong>$total €</strong></td>
                    </tr>
                </tfoot>
            </table>

            <h3>📍 Informations de livraison</h3>
            <p>
                <strong>Nom :</strong> $prenom $nom<br>
                <strong>Email :</strong> $email<br>
                <strong>Téléphone :</strong> $telephone<br>
                <strong>Ville :</strong> $ville<br>
                <strong>Adresse :</strong> $address<br>
                <strong>Méthode de paiement :</strong> $payement_method
            </p>

            <p style='margin-top:30px;'>Nous vous remercions pour votre confiance.<br>
            L'équipe <strong>JTR_Shop</strong>.</p>
        </div>
    ";

        $userMail->send();
    } catch (Exception $e) {
        $_SESSION['checkout_email_error'] = "Could NOT send the checkout  success email :" . $userMail->ErrorInfo;
    }

    header("Location: /Projet-Stage-Initialization/views/checkout_success.view.php");
        exit();
}else{
    $_SESSION['checkout_success'] = 'FAILURE';
    $_SESSION['checkout_error'] = "Something went wrong try again later !";
    header("Location: /Projet-Stage-Initialization/views/checkout.php");
    exit();
}