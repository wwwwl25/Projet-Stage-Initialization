<?php
session_start();

if (!isset($_SESSION["user_email"])) {
    $previous = $_SERVER['HTTP_REFERER'] ?? 'index.php'; // fallback if referrer is not set
    $_SESSION["denied"] = "You need an account to head to the checkout page.";
    header("Location: $previous");
    exit;
}
