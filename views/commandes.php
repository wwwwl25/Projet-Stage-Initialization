<?php
session_start();
require_once '../Connect.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: signup_signin.view.php");
    exit();
}

$connect = new Connect();
$db = $connect->conn;
$user_id = intval($_SESSION['user_id']); 


function calculerTotalCommande($commande_id, $db) {
    $commande_id = intval($commande_id);
    $sql = "SELECT product_id, quantity, category FROM commandes WHERE id = $commande_id";
    $result = mysqli_query($db, $sql);

    if (!$result || mysqli_num_rows($result) === 0) {
        return 0;
    }

    $row = mysqli_fetch_assoc($result);
    $product_id = intval($row['product_id']);
    $quantity = intval($row['quantity']);
    $category = mysqli_real_escape_string($db, $row['category']);

    $sql_produit = "SELECT prix FROM $category WHERE id = $product_id";
    $prod_result = mysqli_query($db, $sql_produit);

    if (!$prod_result || mysqli_num_rows($prod_result) === 0) {
        return 0;
    }

    $prod = mysqli_fetch_assoc($prod_result);
    $prix = floatval($prod['prix']);

    $total = $prix * $quantity;
    return number_format($total, 2);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mes Commandes</title>
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/dashboard_sidebar.css">

    <link rel="stylesheet" href="../styles/commandes.css">
    <link rel="stylesheet" href="../styles/cart.css">

    <!-- Scripts JS -->
    <script src="../scripts/cart.js" defer></script>
    <script src="../scripts/add_to_cart.js" defer></script>
</head>
<body>

<?php require 'utilities/nav-bar.php'; ?>
<?php require 'utilities/cart.php'; ?>

<main class="dashboard_container">
    <?php $title = "Mes commandes";
    require 'utilities/dashboard_sidebar.php' ?>
    <section class="dashboard-content ">

    <?php
    $sql = "SELECT id, created_at FROM commandes WHERE user_id = $user_id ORDER BY created_at DESC";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        echo "<p>Erreur SQL: " . mysqli_error($db) . "</p>";
    } elseif (mysqli_num_rows($result) === 0) {
        echo "<p>Vous n'avez passé aucune commande pour le moment.</p>";
    } else {
        while ($commande = mysqli_fetch_assoc($result)) {
            $commande_id = $commande['id'];
            $date = date("d/m/Y H:i", strtotime($commande['created_at']));
            $total = calculerTotalCommande($commande_id, $db);

            echo "
            <div class='commande'>
                <p><strong>Commande N°:</strong> $commande_id</p>
                <p><strong>Date de l'opération:</strong> $date</p>
                <p><strong>Total:</strong> $total DH</p>
            </div>";
        }
    }
    ?>
</section>
</main>

<?php require 'utilities/footer.php'; ?>

</body>
</html>
