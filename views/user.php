<?php
session_start();
require_once '../Connect.php';

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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon Compte</title>
    <!-- Liens CSS -->
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/user.css">
    <link rel="stylesheet" href="../styles/dashboard_sidebar.css">

    <link rel="stylesheet" href="../styles/cart.css">

    <!-- Scripts JS -->
    <script src="../scripts/cart.js" defer></script>
    <script src="../scripts/add_to_cart.js" defer></script>
</head>
<body>

<?php  $title = "Mon compte"; require 'utilities/nav-bar.php'; ?>
<?php require 'utilities/cart.php'; ?>

<main class="dashboard_container">
    <?php require "utilities/dashboard_sidebar.php"; ?>
    <section class="dashboard-content">
      <p>
        Bonjour <strong><?php echo htmlspecialchars($user_name); ?></strong> (vous n’êtes pas <?php echo htmlspecialchars($user_name); ?> ? <a href="/Projet-Stage-Initialization/controllers/logout.php">Déconnexion</a>)
      </p>
      <p>
        À partir du tableau de bord de votre compte, vous pouvez visualiser vos
        <strong>commandes récentes</strong>, gérer vos <strong>adresses de livraison</strong> et de facturation
        ainsi que <strong>changer votre mot de passe</strong> et les <strong>détails de votre compte</strong>.
      </p>
    </section>
</main>

<?php require 'utilities/footer.php'; ?>

</body>
</html>