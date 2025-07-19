<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: signup_signin.view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
<!--    <link rel="stylesheet" href="../styles/dashboard.css">-->
    <link rel="stylesheet" href="../styles/cart.css">
    <script src="../scripts/cart.js" defer></script>
    <script src="../scripts/add_to_cart.js" defer></script>
</head>
<body>

<?php require 'utilities/nav-bar.php'; ?>
<?php require 'utilities/cart.php'; ?>
  <link rel="stylesheet" href="../styles/product.css">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/boutique.css">

<main>
    <h1>Bonjour, <?php echo htmlspecialchars($_SESSION['user_name']); ?> </h1>

    <section>
        <h2> Mes commandes</h2>
    </section>

    <form action="../controllers/logout.php" method="post">
        <button type="submit">🚪 Se déconnecter</button>
    </form>
</main>

<?php require 'utilities/footer.php'; ?>

</body>
</html>
