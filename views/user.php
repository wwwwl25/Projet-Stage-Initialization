<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: signup_signin.view.php");
    exit();
}

$user_email = $_SESSION['user_email'];
// Extraire la partie avant @ comme nom d'utilisateur
$user_name = strstr($user_email, '@', true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
    <!-- Liens CSS -->
    <link rel="stylesheet" href="../styles/cart.css">
    <link rel="stylesheet" href="../styles/product.css">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/boutique.css">
    <link rel="stylesheet" href="../styles/user.css">

    <!-- Scripts JS -->
    <script src="../scripts/cart.js" defer></script>
    <script src="../scripts/add_to_cart.js" defer></script>
</head>
<body>

<?php require 'utilities/nav-bar.php'; ?>
<?php require 'utilities/cart.php'; ?>

<main>
    <?php require "utilities/dashboard.php"; ?>
    <main class="dashboard-content">
      <p>
        Bonjour <strong><?php echo htmlspecialchars($user_name); ?></strong> (vous n’êtes pas <?php echo htmlspecialchars($user_name); ?> ? <a href="/Projet-Stage-Initialization/controllers/logout.php">Déconnexion</a>)
      </p>
      <p>
        À partir du tableau de bord de votre compte, vous pouvez visualiser vos
        <strong>commandes récentes</strong>, gérer vos <strong>adresses de livraison</strong> et de facturation
        ainsi que <strong>changer votre mot de passe</strong> et les <strong>détails de votre compte</strong>.
      </p>
    </main>
</main>

<?php require 'utilities/footer.php'; ?>

</body>
</html>